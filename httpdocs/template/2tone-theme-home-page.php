                <!-- 2tone - start -->
                <div id="2tone">

                    <!-- left-content -- start -->
                    <div id="left-content">
                        <div class="shadow-purple"></div>

                        <div id="left-top">
                            <!--<h1 class="white">Watch</h1>-->
                        </div>

                        <!-- // Confused? -->
                        <?php
                        $video_counter = 0;
                        foreach ($_SESSION['content_array'] as $record) {
                            if ($record['content_type'] == 'video' && $record['published_status'] == "live" && $video_counter < 3) {
                                echo '
					<div class="left-con-wrapper">
					  <div class="left-con-icon">
						<a href="video.php?id=' . $record['id'] . '&tag=' . $record['page_field1'] . '">
							<img src="images/cms/' . $record['id'] . '/' . $record['page_img_large'] . '" width="190" height="190" alt="' . $record['page_field1'] . '" />
						</a>
					  </div>
		
					  <div class="left-con-text">
						<h3 class="white"><a href="video.php?id=' . $record['id'] . '&tag=' . $record['page_field1'] . '">' . $record['page_title'] . '</a></h3>
						  <span class="black">' . $record['page_desc'] . '</span>
						<h5 class="white"><a href="video.php?id=' . $record['id'] . '&tag=' . $record['page_field1'] . '">Watch Now</a></h5>
					  </div>                                   
					</div>';
                                $video_counter++;
                                if ($video_counter == 3) {
                                    //if article content is NOT less than 3
                                    break; //some some unnecessary looping    
                                }
                            } // end "video_counter" if condition
                        }
                        ;
                        ?>                                               

                        <div class="left-con-button"> <a href="/videos/">
                                <img src="images/videos-button.png" width="190" height="60" alt="Watch Videos" /></a>
                        </div>
                    </div>
                    <!-- left-content -- end -->


                    <!-- right-content -- start -->
                    <div id="right-content">
                        <div class="shadow"></div>
                        <div id="right-top">
                            <!--<h1 class="purple">Read</h1>-->
                        </div>

                        <?php
                        $article_counter = 0;

                        foreach ($_SESSION['content_array'] as $record) {
                            if (($record['content_type'] == 'article' && $article_counter < 3) && $record['published_status'] == "live") {
                                echo '
					<div class="right-con-wrapper">
						<div class="right-con-icon"> <a href="article.php?id=' . $record['id'] . '&tag=' . $record['page_field1'] . '">
						<img src="images/cms/' . $record['id'] . '/' . $record['page_img_large'] . '" width="190" height="190" alt="' . $record['page_field1'] . '" /></a>
					</div>
						<div class="right-con-text">
							<h3 class="purple"><a href="article.php?id=' . $record['id'] . '&tag=' . $record['page_field1'] . '">' . $record['page_title'] . '</a></h3>
							<span class="black">' . $record['page_desc'] . '</span>
							<h5 class="purple"><a href="article.php?id=' . $record['id'] . '&tag=' . $record['page_field1'] . '">Read More</a></h5>
						</div>
					</div>';
                                $article_counter++;
                                if ($article_counter == 3) {
                                    //if article content is NOT less than 3
                                    break; //some some unnecessary looping    
                                }
                            } // end "article_counter" if condition                                  
                        }
                        ;
                        ?>

                        <div class="right-con-button"> <a href="more-articles.php">
                                <img src="images/articles-button.png" width="190" height="60" alt="Read Articles" /></a> 
                        </div>

                    </div>
                    <!-- right-content -- end -->            

                </div>
                <!-- 2tone -- end -->