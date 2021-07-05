<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;

class FrontController extends Controller
{
  public function index()
  {
    $data = FrontController::returnData();


    //set cache key
    $data['articles'] = cache('articles', function () {
      return Post::with('user', 'category')->orderBy('created_at', 'DESC')->take(20)->get();
    });

    //caching
    //check if data is available in cache

    //show from cache

    //if not available, then show from database




    //dd($data);
    return view('index', $data);
  }

  public function post()
  {
    $data = FrontController::returnData();
    $data['post'] = [
      'title' => 'Sample blog post',
      'created_at' => 'January 1, 2014',
      'description' => '<p>This blog post shows a few different types of content thats supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
            <hr>
            <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
            <blockquote>
              <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </blockquote>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            <h2>Heading</h2>
            <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <h3>Sub-heading</h3>
            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            <pre><code>Example code block</code></pre>
            <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
            <h3>Sub-heading</h3>
            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <ul>
              <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
              <li>Donec id elit non mi porta gravida at eget metus.</li>
              <li>Nulla vitae elit libero, a pharetra augue.</li>
            </ul>
            <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
            <ol>
              <li>Vestibulum id ligula porta felis euismod semper.</li>
              <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
              <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
            </ol>
            <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>'
    ];
    return view('frontend.single-post', $data);
  }
  public static function returnData()
  {
    $data = [];
    $data['site_title'] = '<strong>Blog</strong>';
    $data['current_time'] = date('Y m d H:i:s');
    $data['links'] = [
      'Facebook' => '#',
      'Twitter' => '#',
      'Linkedin' => '#',
      'Youtube' => '#'
    ];
    return $data;
  }
}