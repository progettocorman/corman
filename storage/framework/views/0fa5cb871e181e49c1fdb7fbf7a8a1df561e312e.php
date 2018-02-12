<?php
  $id= session('id');
  $publications = \DB::table('friendships')->select('friendships.user_id')->join('users_publications', 'users_publications.user_id', '=', 'friendships.user_id')
                            ->select('publication_id')
                            ->join('publications','publications.id','=','users_publications.publication_id')
                            ->join('users','users.id','=','friendships.user_id')
                            ->select('users_publications.publication_id','users_publications.visibility',
                                   'users.name','users.second_name', 'users.last_name','users.user_image',
                                   'publications.title','publications.venue','publications.volume','publications.number','publications.pages', 'publications.year', 'publications.type','publications.created_at'
                            )->where('friendships.user_follow',$id)->where('users_publications.visibility',0)->orWhere('users_publications.visibility',1)->where('friendships.user_follow',$id)->orderBy('publications.id','desc')->distinct()->get();
  $posts = \DB::table('friendships')->select('friendships.user_id')->join('users_posts', 'users_posts.user_id', '=', 'friendships.user_id')
                            ->select('posts_id')
                            ->join('posts','posts.id','=','users_posts.posts_id')
                            ->join('users','users.id','=','friendships.user_id')
                            ->select('users_posts.posts_id', 'users_posts.visibility',
                                   'users.name','users.second_name', 'users.last_name','users.user_image',
                                   'posts.text','posts.created_at'
                            )->where('friendships.user_follow',$id)->where('users_posts.visibility',0)->orWhere('users_posts.visibility',1)->where('friendships.user_follow',$id)->orderBy('posts.created_at','desc')->distinct()->get();
  $results = array();
  $i = 0;
  foreach ($publications as $publication) {
    $results[$i] = $publication;
    $i++;
  }
  foreach ($posts as $post) {
    $results[$i] = $post;
    $i++;
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('bootstrap', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style>
div.box
{
    width:105%; height:auto ;
    background:url(boxbk.png) no-repeat top left;
    padding:1px 0;
    font-size:10px;
}

div.box-inner
{
    height: 540px;
    overflow:auto;
    margin:25px 24px 0;
    padding-right:2px;
}
</style>
  <body>
  <?php echo $__env->make('navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container-fluid text-center">
  <div class="row content">
      <div class="col-sm-2 sidenav">
      <button class="btn btn-primary" onClick="location.href='post'">New Post</button></br></br>
      <button class="btn btn-primary" onClick="location.href='pubblicazione'"><font size="1px"> New Publication</font></button></br></br>
      <button class="btn btn-primary" onClick="location.href='createGroup'">New Group</button></br></br>

        <?php echo $__env->make('group_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      </div>
    <div class="col-sm-8 text-left">
      <div class="box">
        <div class="box-inner">
      <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(isset($result->posts_id)): ?>
          <!--Allegati  -->
            <?php $attachments = DB::table('attachments_posts')->select('*')->where('posts_id',$result->posts_id)->get(); ?>
         <!--Tags -->
            <?php $tags = DB::table('posts_tags')->select('value')->where('posts_id',$result->posts_id)->get(); ?>

            <div class="riga">
              <hr>
              <h3></h3>
              <p></p>
              <p></p>
              <p></p>
              <p></p>
            </div>

          <table class="tables" width="50%" border="0">
          <tr>
            <td>
                <p><img src="/profile_images/<?php echo e($result->user_image); ?>"style="width:25%; height:25%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px;">
                  &nbsp;&nbsp;<?php echo e($result->name); ?> <?php echo e($result->second_name); ?> <?php echo e($result->last_name); ?></p>
                  <a href="condivisione?idpub=<?php echo e($result->posts_id); ?>&tipo=0"><img src="image/condivisione.png"></a>
            </td>
            </td>
            </tr>
              <tr>
            <td>
              <!--Data Post -->
            <p><?php echo e($result->created_at); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
                </tr>
                <tr>
              <td>

                <!--Dati del Post  -->
              <p> <?php echo e($result->text); ?></p>
              <!--Allegati  -->
              <p><?php if(sizeof($attachments)!=0) echo "Allegati: " ?> <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href=<?php echo e($attachment->namefile); ?>> <?php echo e($attachment->typefile); ?> </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </p>
              <!--Tags-->
              <p><?php if(sizeof($tags)!=0) echo "Tag: " ?> <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <!--TODO visualizzazione tag-->
                  <?php echo e($tag->value); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </p>

                </td>
              </tr>

          </table>
            <?php else: ?>
            <!--Allegati  -->
              <?php $attachments = DB::table('attachments_publications')->select('*')->where('publication_id',$result->publication_id)->get(); ?>
           <!--Tags -->
              <?php $tags = DB::table('publications_tag')->select('value')->where('publications_id',$result->publication_id)->get(); ?>
            <!--Topic -->
              <?php $topic = DB::table('publications')->join('topics','topics_id','=','topics.id')->select('topic_name')->where('publications.id',$result->publication_id)->first(); ?>

              <div class="riga">
                <hr>
                <h3></h3>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
              </div>

            <table class="tables" width="50%" border="0">
            <tr>
              <td>
                  <p><img src="/profile_images/<?php echo e($result->user_image); ?>"style="width:25%; height:25%; -moz-border-radius: 180px; -webkit-border-radius:180px; border-radius:180px;">
                    &nbsp;&nbsp;<?php echo e($result->name); ?> <?php echo e($result->second_name); ?> <?php echo e($result->last_name); ?></p>
                    <a href="condivisione?idpub=<?php echo e($result->publication_id); ?>&tipo=1"><img src="image/condivisione.png"></a>
              </td>

              </tr>
                <tr>
              <td>
                <!--Data Pubblicazione -->
              <p><?php echo e($result->year); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              </td>
                  </tr>
                  <tr>
                <td>

                  <!--Dati della Pubblicazione  -->
                <p> <?php echo e($result->title); ?>

                    <br> <?php echo e($result->type); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                    Published on: <?php echo e($result->venue); ?> <br>
                    <?php if(isset($result->volume)): ?>Volume:<?php echo e($result->volume); ?><?php endif; ?>
                    <?php if(isset($result->number)): ?>, Number: <?php echo e($result->number); ?> ,<?php endif; ?>
                    <?php if(isset($result->pages)): ?>Pages: <?php echo e($result->pages); ?></p><?php endif; ?>
                <!--Allegati  -->
                <p><?php if(sizeof($attachments)!=0) echo "Allegati: " ?> <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <a href=<?php echo e($attachment->namefile); ?>> <?php echo e($attachment->typefile); ?> </a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
                <!--Tags-->
                <p><?php if(sizeof($tags)!=0) echo "Tag: " ?> <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--TODO visualizzazione tag-->
                    #<?php echo e($tag->value); ?>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>

                  </td>
                </tr>
             </table>
           </br>
           </br>
            </br>
            <?php endif; ?>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
   </div>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <?php echo $__env->make('profile_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <button class="btn btn-primary" onClick="location.href='userprofile?id=<?php echo e(session('id')); ?>'">Profile</button>
      </div>
     </div>
  </div>
  </div>
</br>

  <nav class="navbar navbar-default navbar-fixed-bottom"style="text-align:center;height:5%;background-color:#C0C0C0">
  </br>
    <p>@Copyright  Team Corman || Contact us: progettocorman@gmail.com</p>
</nav>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</html>
