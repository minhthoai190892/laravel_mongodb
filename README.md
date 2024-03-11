<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel - MongoDB

## Connect Laravel 10 Project with MongoDB

1.  Create project Laravel

    > composer create-project laravel/laravel test-mongodb

2.  Install MongoDB Package for Laravel
    [Link Install the MongoDB Package for Laravel](https://www.mongodb.com/compatibility/mongodb-laravel-integration)

    > composer require mongodb/laravel-mongodb

3.  Update **database.php** file:-

    In order for Laravel to communicate with your MongoDB database, update database connection information to the config\database.php file under the “connections” object.

    > 'mongodb' => [
    >
    > > 'driver' => 'mongodb',
    > > 'dsn' => env('DB_URI', 'mongodb+srv://username:password@<atlas-cluster-uri>/myappdb?retryWrites=true&w=majority'),
    > > 'database' => 'myappdb',
    > > ],

## 4. Update .env file:-

    Now, update the .env file to connect with the MongoDB database. Update DB_CONNECTION as mongodb, DB_DATABASE as your database name like laravelmongo in our case and DB_URI as mongodb://localhost:27017.


         DB_CONNECTION=mongodb
         DB_HOST=127.0.0.1
         DB_PORT=27017
         DB_DATABASE=laravelmongo
         DB_USERNAME=
         DB_PASSWORD=
         DB_URI=mongodb://localhost:27017

## Register and Login User with Laravel using MongoDB

## 5. Run "php artisan migrate"

Run the "php artisan migrate" command to add default auth tables like users in laravelmongo database.

## 6. Test at MongoDB Compass:-

Finally, test at MongoDB Compass to check if all the default collections including the users collection added to the laravelmongo database.

-   Run below command
    > npm install
    > npm run dev

## Alternative commands :

    Installation. The Bootstrap and Vue scaffolding provided by Laravel is located in the laravel/ui Composer package, which may be installed using Composer:

> -   composer require laravel/ui --dev
> -   php artisan ui bootstrap --auth
>     or
> -   php artisan ui vue --auth

-   Update User.php:
    > Replace Authenticatable class at User model that we will fetch from MongoDB
    > Replace
    > use Illuminate\Foundation\Auth\User as Authenticatable;
    > With
    > use MongoDB\Laravel\Auth\User as Authenticatable;

## CRUD Operations

1. Create a Post Model with a Resource Controller
   Run below command:
    > php artisan make:model Post -mcr
2. Update the create\*posts_table migration file and add title, description, and status columns to it.
   \*\**(F1 =>create*posts_table)\*\*\*

    table: **Post**
    | title | string |
    |---|---|
    | description | text |
    |status| tinyInteger|

3. Run the "php artisan migrate" command to create a posts table
4. Create Route:- **web.php**

    > Route::resource('posts', 'App\Http\Controllers\PostController');

5. Update the "create" function at **PostController** **_(gọi trang create)_**

```
    public function create()
    {
        // trả vê trang cần hiển thị
        return view("posts.create");
    }
```

6. Create a posts folder at /resources/views/ and create a file create.blade.php **_(tạo trang create)_**

7)  Copy content from the register.blade.php file and make changes accordingly. Add title and description fields with the submit button.
8)  Update **store function** at **PostController**:- **_(lưu trữ dữ liệu)_**

    ```
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($request->isMethod('post')) {
            # code...
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $post = new Post;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->status =1;
            $post->save();
            return redirect()->back()->with('success_message','Post add success');

        }
    }
    ```

9)  Update the **Post model** and connect mongodb

    > use MongoDB\Laravel\Eloquent\Model;

    ````
      //khai báo kết nối vói mongodb
      protected $connection = 'mongodb' ;
      ```

    ````

10) Update create.blade.php file :-
    Show a success message after posting data.

```
@if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Succsess!</strong>{!! session('success_message') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
```

## MongoDB CRUD Operations | Get data in Laravel from MongoDB

1. Update index function :-
   First of all, we will update **index function** to get posts data from Post collection from MongoDB.

```

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        // lấy dữ liệu
        $posts = Post::get()->toArray();
        // hiển thị dữ liệu tạm thời
        // dd($posts);
        // trả về tra hiển thị
        return view('posts.show')->with(compact('posts'));
    }
```

2. Create show.blade.php file :-
   Now create **show.blade.php** file under _/resources/views/posts/_ to display all posts in foreach loop.

3. Integrate Datatable :-
   Now we will integrate datatable from below link:
   https://datatables.net/examples/styli...

4. Update app.blade.php file :-
   Now we will include Datatable CSS and JS files in the **app.blade.php** file.

```
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css">

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>

<script>
    // hiển thị data trong DataTable
        $(function () {
            $("#postsID").DataTable();
        });
    </script>

```

## Edit data in MongoDB with Laravel

1. Update **show.blade.php** file :-
   First of all, we will update the **show.blade.php** file to add an "Update" link with every post with post id.
    > <td><'a href="{{ url('posts/' . $post['_id'] . '/edit') }}">Update</a></td>

2) Update edit function:-
   Now, we will update the edit function at **PostController** to get the post data from post \_id and send it to the post edit form we will create in our next step.

    ```

     /**
      * Show the form for editing the specified resource.
      */
     public function edit(Post $post)
     {
         //!TODO: test thông tin bài post
         // echo $post['_id'];die;
         //!TODO: tìm bài post trong csdl
         $postDetails = Post::find($post['id']);
         //!TODO: dùng để kiểm tra mảng bài post
         // dd($postDetail);
         return view('posts.edit')->with(compact('postDetails'));
     }
    ```

3) Create **edit.blade.php** file :-
   Now we will create an **edit.blade.php** file at _/resources/views/posts/_ folder and show the current post title and description in edit post form. Also, add the Laravel PUT method

    ## config

    ```
    <form method="POST" action="{{ route('posts.update',[$postDetails['_id']]) }}">
    @csrf
      {{-- thây đổi sang phương thuc PUT --}}
        @if (isset($postDetails['_id'])) @method('PUT') @endif

      <input value="{{ $postDetails['title'] }}"></input>
       <textarea id="description" type="description"
            class="form-control @error('description') is-invalid @endename="description"
            rows="10" required>
             {{ $postDetails['description'] }}
        </textarea>
        ....
    </form>
    ```

4) Update update function:-
   Now, we will update the "update" function to finally edit the post. We will get the post data in the put method and write the Laravel query to update it.
    ```
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //!TODO: xem dữ liệu trước update
        echo $post;
        echo '--';
        if ($request->isMethod('PUT')) {
            //!TODO: lấy dữ liệu được update
            $data = $request->all();
            //!TODO: kiểm tra dữ liệu sau update
            // echo "<pre>";print_r($data);die;
            //!TODO: UPdate vào database
            Post::where('_id', $post['_id'])->update(['title' => $data['title'], 'description' => $data['description']]);
            //!TODO: hiển thị trang show với message
            return redirect('/posts')->with('success_message','Post updated successfully');
        }
    }
    ```
5) Update **show.blade.php** to show message
    ```
    @if (Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succsess!</strong>{!! session('success_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    ```

# MongoDB CRUD Operations | Delete data in MongoDB with Laravel

1. Update **show.blade.php** file :-
   First of all, we will update <a href='resources\views\posts\show.blade.php'>show.blade.php</a> file to add "Delete" button with every post with post id. We will also add button for "Update" and will use form for deleting post as this is the correct way to do in resource controller.
    ```
     <form action="{{ route('posts.destroy', ['post' => $post['_id']]) }}"
        method="POST" style="float: right;margin-left: 10px">
         @csrf @method('delete')
         <button type="submit" class="btn btn-primary btn-block">Delete</button>
     </form>
    ```

2) Update **destroy** function :-
   Now, we will update **destroy** function at <a href='app\Http\Controllers\PostController.php'>PostController</a> to delete the post from post \_id and redirect to posts page with success message.
    ```
      /**
      * Remove the specified resource from storage.
      * @param Post $post cần một bài đăng để xóa
      */
     public function destroy(Post $post)
     {
         // xem dữ liệu cần xóa
         // echo($post);die;
         // kiểm tra id bài đăng
         if (isset($post['_id'])) {
             // kiểm tra id bài đăng trong csdl có giống với id cần xóa không
             Post::where('_id', $post['_id'])->delete();
             return redirect('/posts')->with('success_message', 'Post deleted successfully');
         }
     }
    ```
