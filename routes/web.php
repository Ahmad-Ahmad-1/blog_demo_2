<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PostController::class, 'latestPosts'])->name('home');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::resource('/posts', PostController::class)->except(['show', 'destroy']);
  Route::delete('/posts/{post}/{redirect?}', [PostController::class, 'destroy'])->name('posts.destroy');
  Route::get('/posts/my-posts', [PostController::class, 'myPosts'])->name('posts.my_posts');

  Route::resource('/roles', RoleController::class);

  Route::resource('/users', UserController::class);

  Route::get('/test', function () {
    $post = Post::find(40);
    return view('test', ['post' => $post]);
  })->name('test');
});

Route::get('/posts/{post}/{redirect?}', [PostController::class, 'show'])->name('posts.show');

require __DIR__ . '/auth.php';

/*
  - In Storage:

    * driver:
      the place where the data will be stored (local (on your server), S3 (on Amazon storage),
      ftp, sftp (For FTP/SFTP storage)).

    * disk:
      you can think of it literally like your PC's disk, and differnt
      disks could be on different drivers.

    * root:
      root in is just disk's root.

    * url:
      This is the URL that can be used to access files stored in this disk.

    * visibility:
      public: Files are accessible publicly via the web.
      private: Files are not accessible without specific permissions.

    * throw
      Determines whether exceptions should be thrown when file operations fail. In this case, it's
      set to false, meaning errors will be handled silently.

  - Notes:

    * a driver could be a set of disks like your PC's hard drive is a set of partitions.

    * note that storage_path() function points to the storage directory of your Laravel application
      and its output is something like this: C:\xampp\htdocs\your_project\storage and any argument you
      pass to it as first paramter will be appended to the returned path (the same goes for public_path()
      except it returns the public directory path).

    * when setting a disk's visibility to private, it means its files are intended for internal use within
      the application and are not meant to be publicly accessible (so don't use this visibility for files
      you want users to access and use it for files that are used only for development purposes).

    * root and url values don't affect each other.

*/

/*
  - Media Library:

    * each media file will be uploaded to a directory which has the media file's id as
      a name and the file will preserve its original name by default (this can be changed
      of course).

    * $post->getMedia()
      this will return a MediaCollection object contains all the media associated with
      this resource.

    * $post->getFirstMedia()
      this will return a Media object contains the first media associated with this resource.

    * $post->getFirstMedia()->getUrl();
      this will return the URL of the file, for convenience it could be written like
      this: $post->getFirstMediaUrl();
      
    * $post->getFirstMedia()->getPath();
      this will return the absolute path of the file.

    * $post->addMediaFromRequest('img')->toMediaCollection();
      - this will upload a file directly from the request (it expects
        the key of the uploaded file as its argument).

      - adding a media collection for media (by passing it as an argument) is crucial if
        you have multiple media files associated with the same model (and then you need to pass
        this media collection name when retrieving media using getMedia(), getFirstMedia().. etc).

    * $post->addMedia()->toMediaCollection();
      this will upload a file from anywhere you want.

    * $post->addMediaFromRequest()->usingName()->usingFileName()->toMediaCollection();
      usingName() will let you define the value for the name column of the media table.
      usingFileName() will let you define the file name (used in filesystem and media table file_name column).

    * $post->addMediaFromRequest('img')->withCustomProperties([
                'location' => 'my PC',
                'price' => 'freepik'
            ])->toMediaCollection();
      
      this will add the custom properties you pass to the custom_properties column in media table (serialized
      as JSON).

    * $post->delete()
      the regular model's delete method will delete its database record as well as all media associated with
      it in database and filesystem! you don't need to anything!
    
*/

/*
  - Model Deletion
   
    * Post::find($id)->delete();
      this will delete the model as well as its associated media table records and files in filesystem.

    * Post::where('id', '=', $id)->delete()
      this will delete the model, but its associated media table records and files in filesystem won't
      be affected, because the delete method hasn't been called on the model itself which means that delete
      model event won't be fired (which the Media package listen to for deleting associated media), and it's
      called on a query builder instead.

*/