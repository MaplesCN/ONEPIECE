<div id="footer"><footer id="colophon" class="site-footer"><?php get_template_part('template-parts/footer/footer','widgets'); ?><div class="site-info"><?php if(has_nav_menu('footer')):?><nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer Menu','twentynineteen');?>"><?php wp_nav_menu(array('theme_location'=>'footer','menu_class'=>'footer-menu',));?></nav><?php endif; ?>
<a href="#top" style="float:right"><i class="fa-solid fa-caret-up"></i>顶部</a><li style="float:right"><a id='dark-toggler'></a></li>
<div style="margin-top:2rem" align="center"><div class="logo" style="height:30px;width:38.3px"></div>
&copy<?php echo date('Y');?> <a href="<?php echo home_url(); ?>"><?php bloginfo('site_name');?></a><br><?php echo '第',round((strtotime(date("Y-m-d"))-strtotime("2018-02-01"))/3600/24),'天';?></div>
</div></footer></div><?php wp_footer(); ?></body></html>