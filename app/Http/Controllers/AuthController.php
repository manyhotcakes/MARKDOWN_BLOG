<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use Carbon\Carbon;
use DB;
use Storage;
use Log;

class AuthController extends Controller
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

    /**
     * [upload description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
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
            return redirect()->route('home')->with('success', '保存しました。');
          } catch (\Exception $e) {
            // 失敗時はロールバック
            DB::rollback();
            if ($image_path) {
              Storage::delete($image_path);
            }
            Log::error($e);
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['article' => 'エラーが発生しました。' . $e->getMessage()]);
          }
      }

      return redirect()
              ->back()
              ->withInput()
              ->withErrors(['article' => '画像がアップロードされていないか不正なデータです。']);
    }

    /**
     * [remove description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function remove($id) {
      DB::beginTransaction();
      try {
        $article = Article::find($id);
        $article->delete_flg = true;
        $article->save();
        DB::commit();
        return redirect()->route('home')->with('success', '保存しました。');
      } catch (\Exception $e) {
        // 失敗時
        Log::error($e);
        return redirect()
                ->back()
                ->withInput()
                ->withErrors(['article' => '削除に失敗しました']);
      }
    }
}
