<!-- start footer -->
    <?php global $themeum_options; ?>
    <footer id="footer" class="footer-wrap">
        <div class="footer-wrap-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="thm-footer-1-inner">
                            <?php dynamic_sidebar('Footer 1'); ?>   
                            <?php if (isset($themeum_options['copyright-en']) && $themeum_options['copyright-en']){?>
                                <div class="copyright">
                                    <?php if(isset($themeum_options['copyright-text'])) echo balanceTags($themeum_options['copyright-text']); ?>
                                </div>
                                <?php } ?>    
                        </div>            
                    </div>            
                    <div class="col-md-2 col-sm-3 col-xs-4">
                        <?php dynamic_sidebar('Footer 2'); ?>   
                     </div>

                     <div class="col-md-2 col-sm-3 col-xs-4">
                        <?php dynamic_sidebar('Footer 3'); ?>
                     </div> 

                     <div class="col-md-2 col-sm-3 col-xs-4">
                        <?php dynamic_sidebar('Footer 4'); ?>  
                     </div> 

                     <div class="col-md-2 col-sm-3 col-xs-4">
                        <?php dynamic_sidebar('Footer 5'); ?>   
                     </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end footer-wrap-inner -->
    </footer>
</div> <!-- #page -->
<?php wp_footer(); ?>

<?php if(isset($themeum_options['custom_js']) && !empty($themeum_options['custom_js'])): ?>
<script type="text/javascript">
    <?php print $themeum_options['custom_js']; ?>
</script>
<?php endif; ?>
</body>
</html>