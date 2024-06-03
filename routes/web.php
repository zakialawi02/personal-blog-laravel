<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ArticleViewController;
use App\Http\Controllers\MentionNotificationController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('filemanager')->as('lfm.')->group(function () {
    Route::get('/', function () {
        abort(404);
    });
    Route::any('/{any?}', function () {
        abort(404);
    })->where('any', '.*');
});

Route::get('/log', function () {
    return view('pages.login');
});


Route::prefix('admin')->as('admin.')->group(function () {
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    // route auth admin and writer
    Route::middleware(['auth', 'verified', 'role:admin,writer'])->group(function () {
        Route::get('/my-files', [PostController::class, 'myFilesManager'])->name('myfiles');

        Route::post('/posts/generateSlug', [PostController::class, 'generateSlug'])->name('posts.generateSlug');
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

        Route::resource('users', UserController::class)->except('create', 'edit');

        Route::get('/posts/stats/6months', [ArticleViewController::class, 'getViewsLast6Months'])->name('posts.statslast6months');
        Route::get('/posts/stats', [ArticleViewController::class, 'getArticleStats'])->name('posts.statsview');
        Route::get('/stats/posts/{slug}', [ArticleViewController::class, 'statsPerArticle'])->name('posts.statsdetail');
        Route::get('/stats/locations', [ArticleViewController::class, 'statsByLocation'])->name('posts.statslocation');

        Route::resource('tags', TagController::class)->parameters(['tags' => 'tag:slug']);
        Route::post('/tags/generateSlug', [TagController::class, 'generateSlug'])->name('tags.generateSlug');
    });

    // route auth only admin
    Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
        Route::post('/categories/generateSlug', [CategoryController::class, 'generateSlug'])->name('categories.generateSlug');
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
        Route::delete('/newsletter/{newsletter:email}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');

        Route::get('/pages/{id}/load-project', [PageController::class, 'loadProject'])->name('pages.loadproject');
        Route::patch('/pages/{id}/store-project', [PageController::class, 'storeProject'])->name('pages.storeproject');
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::get('/pages/{page:id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::get('/pages/{page:id}/builder', [PageController::class, 'builder'])->name('pages.builder');
        Route::put('/pages/{page:id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{page:id}', [PageController::class, 'destroy'])->name('pages.destroy');

        Route::resource('menu-items', MenuItemController::class);
    });

    // route auth all
    Route::group(['middleware' => ['auth', 'verified', 'role:admin,writer,user']], function () {
        Route::post('/requests-contributors', [UserController::class, 'joinContributor'])->name('requestsContributors');
        Route::post('/requests-contributors/confirm', [UserController::class, 'confirmCodeContributor'])->name('confirmCodeContributor');

        Route::get('/my-comments', [CommentsController::class, 'myindex'])->name('mycomments.index');
        Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');

        Route::delete('/comments/{comment:id}', [CommentsController::class, 'destroy'])->name('comment.destroy');
        Route::post('/comments/{post:slug}', [CommentsController::class, 'store'])->name('comment.store');

        Route::get('/notifications', [MentionNotificationController::class, 'index'])->name('notifications');
        Route::get('/get-notifications', [MentionNotificationController::class, 'getNotifications'])->name('getNotifications');
        Route::put('/mark-as-read-all', [MentionNotificationController::class, 'markAsReadAll'])->name('markAsReadAll');
    });
});

Route::get('/posts', [\App\Http\Controllers\Api\ArticlesController::class, 'index'])->middleware('auth')->name('posts.data');

// route auth all
Route::middleware(['auth', 'verified', 'role:admin,writer,user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', function () {
        return redirect('/dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [ArticleController::class, 'index'])->name('article.index');
Route::get('/blog/popular', [ArticleController::class, 'popularPost'])->name('article.popular');
Route::get('/blog/tags/{slug}', [ArticleController::class, 'getArticlesByTag'])->name('article.tag');
Route::get('/blog/categories/{slug}', [ArticleController::class, 'getArticlesByCategory'])->name('article.category');
Route::get('/blog/users/{username}', [ArticleController::class, 'getArticlesByUser'])->name('article.user');
Route::get('/blog/archive/{year}', [ArticleController::class, 'getArticlesByYear'])->name('article.year');
Route::get('/blog/archive/{year}/{month}', [ArticleController::class, 'getArticlesByMonth'])->name('article.month');
Route::get('/blog/{year}/{slug}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/p/{page:slug}', [PageController::class, 'show'])->name('page.show');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');


Route::get('privacy-policy', function () {
    return view('pages.front.privacyPolicy');
})->name('privacyPolicy');
Route::get('terms-and-conditions', function () {
    return view('pages.front.termCondition');
})->name('termsAndConditions');


Route::post('/show-comment/{post:slug}', [CommentsController::class, 'showArticleComment'])->name('showArticleComment');
Route::post('/show-comment-section', [ArticleController::class, 'showCommentSection'])->name('showCommentSection');


require_once __DIR__ . '/auth.php';


// INERTIA ROUTES
require_once __DIR__ . '/inertia.php';
