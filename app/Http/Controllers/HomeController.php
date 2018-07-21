<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use Carbon\Carbon;
use DB;
use Storage;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('delete_flg', false)
        ->orderBy('id', 'desc')
        ->paginate(2);
        return view('auth/home', ['articles' => $articles]);
    }

    public function uploadForm()
    {
        return view('auth/upload');
    }

    public function upload(Request $request)
    {
      $UPLOAD_FILESIZE_MAX = env("UPLOAD_FILESIZE_MAX");
      $user_id = auth()->id() ?? NULL;

      $this->validate($request, [
          'subject' => [
              'required',
              'string',
              'max:255'
          ],
          'file' => [
              // 必須
              'required',
              // アップロードされたファイルであること
              'file',
              // MIME制限
              'mimetypes:text/plain,text/markdown',
              // ファイルサイズ制限
              'max:'. 1024 * 2 .'',
          ],
          'image' => [
            'required',
            'image',
            "max:${UPLOAD_FILESIZE_MAX}"
          ]
      ]);
      if ($request->file('file')->isValid() && $request->file('image')->isValid()) {
          DB::beginTransaction();
          try {
            $body = file_get_contents($request->file('file')->getRealPath());
            // ファイル名の決定
            $currenttime_withmicro = Carbon::now()->timestamp . Carbon::now()->micro;
            $extention = $request->file('image')->getClientOriginalExtension();
            $imagefilename = "{$user_id}_{$currenttime_withmicro}.{$extention}";
            // ストレージに保存
            $image_path = $request->image->storeAs(
              'image', $imagefilename, ['disk' => 'public']
            );

            $article = new Article;
            $article->subject = $request->subject ? $request->subject : 'Untitled';
            $article->author_id = $user_id;
            $article->author_ip = \Request::ip();
            $article->body = $body;
            $article->image_path= $image_path;
            $article->save();
            DB::commit();
            return redirect('/home')->with('success', '保存しました。');
          } catch (\Exception $e) {
            // 失敗時はロールバック
            DB::rollback();
            if ($image_path) {
              Storage::delete($image_path);
            }
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['file' => 'エラーが発生しました。' . $e->getMessage()]);
          }
      }

      return redirect()
              ->back()
              ->withInput()
              ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
    }
}
