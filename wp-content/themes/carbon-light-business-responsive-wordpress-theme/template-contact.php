<?php

/* Template Name: Page Contact */

get_header(); ?>

    <div class="otw-twentyfour otw-columns otw-content-secotion">

    <?php otw_breadcrumb(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php the_content(); ?>

            <div class="otw-row ">
              <div class="otw-eighteen otw-columns">
                <iframe width="100%" scrolling="no" height="360" frameborder="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=bg&amp;geocode=&amp;q=1+Madison+Avenue,+New+York,+United+States&amp;aq=0&amp;oq=1+madison+avenue,+new+york&amp;sll=40.741284,-73.987383&amp;sspn=0.009186,0.01929&amp;ie=UTF8&amp;hq=&amp;hnear=1+Madison+Ave,+New+York,+10010&amp;t=m&amp;ll=40.741274,-73.987341&amp;spn=0.026012,0.059996&amp;z=14&amp;iwloc=A&amp;output=embed" marginwidth="0" marginheight="0"></iframe>
              </div>
              <div class="otw-six otw-columns">
                <div>
                  <h3>Where can you find us</h3>
                    <p>Street 19, Your City, Post Code 9019<br>
                    Country Name</p>
                    <p>Phone +0123 4567890<br>
                    Mobile +0123 4567890<br>
                    Email office@yourcarbon.com</p>
                </div>
                <div>
                  <h3>Information</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div class="otw-sc-social-icons medium">
                <h3 class="widget-title">Follow us</h3>
                    <ul>
                      <li><a href="#"><i class="social foundicon-rss"></i></a></li>
                      <li><a href="#"><i class="social foundicon-facebook"></i></a></li>
                      <li><a href="#"><i class="social foundicon-twitter"></i></a></li>
                      <li><a href="#"><i class="social foundicon-pinterest"></i></a></li>
                      <li><a href="#"><i class="social foundicon-linkedin"></i></a></li>
                    </ul>
                  </div>
              </div>
            </div>

            <div class="otw-row">
              <div class="otw-sc-contact-form">
                <form action="#" id="contactForm" method="post">
                  <div class="otw-eight otw-columns">
                    <label for="contactName">Name<span class="additional required">*</span></label>
                    <input type="text" name="contactName" id="contactName" value="" class="txt requiredField">

                    <label for="email">Email<span class="additional required">*</span></label>
                    <input type="text" name="email" id="email" value="" class="txt requiredField email">

                    <label for="subject">Subject<span class="additional">(optional)</span></label>
                    <input type="text" name="subject" id="subject" value="" class="txt requiredField email">
                  </div>

                  <div class="otw-sixteen otw-columns">
                    <label for="commentsText">Message<span class="additional required">*</span></label>
                    <textarea name="comments" id="commentsText" rows="8" cols="30" class="requiredField"></textarea>
                    <div class="right">
                      <span class="additional required">* this field is mandatory</span>
                      <input type="checkbox" class="checkbox" name="sendCopy" id="sendCopy" value="true"><label class="inline" for="sendCopy">Send a copy of this email to yourself</label>
                       <button class="radius button" type="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

			<?php edit_post_link(); ?>

		</article>

	<?php endwhile; ?>

	<?php else: ?>

		<article>
			<h1><?php _e( 'Sorry, nothing to display.', 'otw-carbon-light' ); ?></h1>
		</article>

	<?php endif; ?>

    </div>

<?php get_footer(); ?>