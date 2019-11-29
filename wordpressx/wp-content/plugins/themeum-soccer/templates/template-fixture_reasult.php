<?php 
get_header(); 
?>

<?php if ( have_posts() ) : the_post(); ?>


    <?php

       function themeum_cat_list( $id,$cat ){
            $output = array();
            $term_list = get_the_terms($id,$cat);
            if(is_array($term_list)){
                foreach ($term_list as $value) {
                    $output[] = $value->name;
                }
                $output = implode(",", $output);
            }
            return $output;
        }


        // Date With GMT Value
        $datetime    = get_post_meta(get_the_ID(),'themeum_datetime',true);
        $gmt    = get_post_meta(get_the_ID(),'themeum_gmt',true);
        $sports_date = '';
        if($datetime != ''){
            $sports_date = date_format(date_create($datetime), 'd M Y h:i A').' '.$gmt;
        }

        // Club Name
        $team_1_group    = get_post_meta(get_the_ID(),'team_1_group',true);

        $team_2_group    = get_post_meta(get_the_ID(),'team_2_group',true);

        $match_result_group    = get_post_meta(get_the_ID(),'match_result_group',true);

        // Goal and Timing 
        $goal_timing_group    = get_post_meta(get_the_ID(),'goal_timing_group',true);

        $goal_timing_group_extra    = get_post_meta(get_the_ID(),'goal_extra_timing',true);

        // Match timeline
        $match_timeline    = get_post_meta(get_the_ID(),'match_timeline',true);

        // Match Substitutes
        $substitutes    = get_post_meta(get_the_ID(),'match_substitutes',true);

    ?>
        <section id="main">
            <?php 
            $attach_id = get_post_thumbnail_id();
            if( $attach_id ){
                echo '<div class="match-banner sub-title" style="background-image:url('.wp_get_attachment_url(get_post_thumbnail_id()).');background-size: cover;background-position: 50% 50%;padding:100px 0 50px">';
            }else{ ?>
                <div class="match-banner sub-title" style="background-image:url(<?php echo get_template_directory_uri().'/images/match-banner.jpg';?>);background-size: cover;background-position: 50% 50%;padding:100px 0 50px">
            <?php }
            ?>
                <div class="container">
                    <div class="text-center">
                    <h2 class="match-detail-league-title"><a href="#"><?php echo themeum_cat_list( get_the_ID(),'league' ); ?> - <?php echo $sports_date; ?></a></h2>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 matech-team-left">
                            <div class="matech-team pull-right">
                                <div class="icon-left">
                                    <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                        <img width="61" src="<?php echo themeum_logo_url_by_id($team_1_group['themeum_club_name1']); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="title">
                                    <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                        <h4><?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="goal-count media">
                                <div class="pull-right">
                                    <img src="<?php echo esc_url(get_template_directory_uri().'/images/goal.png'); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                                </div>
                                <div class="media-body text-right">
                                    <ul>
                                    <?php
                                    $goal1 = $goal2 = 0;
                                    if(is_array($goal_timing_group)){
                                        
                                        foreach ($goal_timing_group as $value){
                                            if (isset($value['themeum_select_team'])) {
                                                if($value['themeum_select_team'] == 'value1'){
                                                    $goal1++;
                                                    if (isset($value['themeum_goal_player'])) {
                                                        $player_name = themeum_get_title_by_id($value['themeum_goal_player']);
                                                        if( $value['themeum_goal_player'] != '' ){
                                                            echo "<li>".$player_name." ".$value['themeum_time_of_goal']."'</li>";
                                                        }
                                                    }

                                                }

                                                if($value['themeum_select_team'] == 'value2'){ 
                                                    $goal2++; 
                                                }
                                            }
                                        }


                                        if(is_array( $goal_timing_group_extra )){
                                            if(!empty($goal_timing_group_extra)){
                                                foreach ($goal_timing_group_extra as $value) {
                                                    if(isset($value['themeum_extra_select_team'])){
                                                        if(isset($value['themeum_extra_time_of_goal'])){        
                                                            if($value['themeum_extra_goal_player'] != ''){
                                                                
                                                                $player_name = themeum_get_title_by_id($value['themeum_extra_goal_player']);
                                                                if( $value['themeum_extra_select_team'] == 'value1' ){
                                                                    echo "<li>".$player_name." ".$value['themeum_extra_time_of_goal']."'</li>";
                                                                    $goal1++;
                                                                }
                                                            }
                                                        }
                                                        if($value['themeum_extra_select_team'] == 'value2'){ $goal2++; }
                                                    }
                                                }
                                            }
                                        }


                                    }
                                    ?>
                                    </ul>
                                    
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-4 score">
                            <span>
                                <?php 
                                $total_goal = get_post_meta( get_the_ID(), 'themeum_goal_count', true);
                                echo $total_goal;
                                ?>
                            </span>
                        </div>

                        <div class="col-xs-12 col-sm-4 matech-team-right">
                            <div class="matech-team pull-left">
                                <div class="title">
                                    <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                        <h4><?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?></h4>
                                    <?php endif; ?>
                                </div>
                                <div class="icon-right">
                                    <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                        <img width="61" src="<?php echo themeum_logo_url_by_id($team_2_group['themeum_club_name2']); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="goal-count media">
                                <div class="pull-left">
                                    <img src="<?php echo esc_url(get_template_directory_uri().'/images/goal.png'); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                </div>
                                <div class="media-body">
                                    <ul>
                                    <?php
                                    if(is_array($goal_timing_group)){
                                        
                                        foreach ($goal_timing_group as $value){
                                            if (isset($value['themeum_select_team'])) {
                                                if($value['themeum_select_team'] == 'value2'){
                                                    if (isset($value['themeum_goal_player'])) {
                                                        $player_name = themeum_get_title_by_id($value['themeum_goal_player']);
                                                        if( $value['themeum_goal_player'] != '' ){
                                                            echo "<li>".$player_name." ".$value['themeum_time_of_goal']."'</li>";
                                                        }
                                                    }
                                                }
                                            }
                                        }



                                        if(is_array( $goal_timing_group_extra )){
                                            if(!empty($goal_timing_group_extra)){
                                                foreach ($goal_timing_group_extra as $value) {
                                                    if(isset($value['themeum_extra_select_team'])){
                                                        if($value['themeum_extra_select_team'] == 'value2'){
                                                            $player_name = themeum_get_title_by_id($value['themeum_extra_goal_player']);
                                                            if( $value['themeum_extra_select_team'] == 'value2' ){
                                                                echo "<li>".$player_name." ".$value['themeum_extra_time_of_goal']."'</li>";
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }


                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="goal-timeline hidden-xs">
                    <?php
                        $timing = get_post_meta(get_the_ID(),'goal_timing_group',true);
                        $li_builder_1 = $li_builder_2 = $li_builder_3 = '';
                        
                        foreach ($timing as $value) {
                            if (isset($value['themeum_time_of_goal'])) {
                                $goal_time = $value['themeum_time_of_goal'];
                                    if( $goal_time <= 45 ){
                                        $li_builder_1 .= '<li style="left:'.floor((100/45)*$goal_time).'%" class="team1 goal">';
                                        if (isset($value['themeum_goal_player'])) {
                                            $li_builder_1 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_goal_player']).' '.$goal_time.'"</span>';
                                        }
                                        $li_builder_1 .= '</li>'; 
                                    }
                                    if( $goal_time > 45 ){
                                        if( $goal_time > 90 ){
                                            $li_builder_2 .= '<li style="left:100%" class="team1 goal">';
                                            if (isset($value['themeum_goal_player'])) {
                                                $li_builder_2 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_goal_player']).' '.$goal_time.'"</span>';
                                            }
                                            $li_builder_2 .= '</li>'; 
                                        }else{
                                            $li_builder_2 .= '<li style="left:'.floor((100/90)*$goal_time).'%" class="team1 goal">';
                                            if (isset($value['themeum_goal_player'])) {
                                                $li_builder_2 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_goal_player']).' '.$goal_time.'"</span>';
                                            }
                                            $li_builder_2 .= '</li>'; 
                                        } 
                                    }
                                }
                            }

                            $extra_timing = get_post_meta( get_the_ID(),'goal_extra_timing',true );
                            $total_timing = get_post_meta( get_the_ID(),'themeum_extra_time',true );

                            if(is_array( $extra_timing )){
                                if(!empty( $extra_timing )){
                                    if( $total_timing != "" && $total_timing != 0 ){
                                        foreach ($extra_timing as $value) {

                                            if( $value['themeum_extra_time_of_goal'] != '' ){
                                                $li_builder_3 .= '<li style="left:'.floor((100/$total_timing)*$value['themeum_extra_time_of_goal']).'%" class="team1 goal">';
                                                    $li_builder_3 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_extra_goal_player']).' '.( 90+$value['themeum_extra_time_of_goal'] ).'"</span>';
                                                $li_builder_3 .= '</li>';
                                            }

                                        }
                                    }
                                }
                            }



                            echo '<span class="timeline-titme">00"</span>';
                            echo '<ul class="goal-timeline1">';
                                echo $li_builder_1;
                            echo '</ul>';
                            echo '<span class="timeline-titme">45"</span>';
                            echo '<ul class="goal-timeline2">';
                                echo $li_builder_2;
                            echo '</ul>';
                            echo '<span class="timeline-titme">90"</span>';

                            if(isset($total_timing)){
                                if( $total_timing != '' ){
                                    echo '<div class="extra-time-goal">';
                                        echo '<span class="timeline-titme">+</span>';
                                        echo '<ul class="goal-timeline2">';
                                            echo $li_builder_3;
                                        echo '</ul>';
                                        echo '<span class="timeline-titme">'.$total_timing.'"</span>';
                                    echo '</div>';        
                                }
                            }

                            
                    ?>
 
                    </div><!--/#result-details-->   
                </div> <!--container-->
            </div> <!--match-banner-->

            <div class="match-details">
                <div class="container">
                    <div class="match-details-inner">
                        <div class="match-details-tab" role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs match-details-tab-nav" role="tablist">
                                <li role="presentation" class="active"><a href="#match-stats" aria-controls="match-stats" role="tab" data-toggle="tab"><?php _e('Match Stats','themeum-soccer');?></a></li>
                                <li role="presentation"><a href="#timeline" aria-controls="timeline" role="tab" data-toggle="tab"><?php _e('Timeline','themeum-soccer');?></a></li>
                                <li role="presentation"><a href="#team" aria-controls="team" role="tab" data-toggle="tab"><?php _e('Team','themeum-soccer');?></a></li>
                                <li role="presentation"><a href="#substitutes" aria-controls="substitutes" role="tab" data-toggle="tab"><?php _e('Substitutes','themeum-soccer');?></a></li>
                                <li role="presentation"><a href="#match_comments" aria-controls="match_comments" role="tab" data-toggle="tab"><?php _e('Comments','themeum-soccer');?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content match-details-tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="match-stats">
                                
                                    <div class="match-status">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="matech-details-team media">
                                                    <div class="pull-left">
                                                    <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_1_group['themeum_club_name1']); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                    <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?></h4>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                        <span>
                                                        <?php if( isset($team_1_group['themeum_formation1']) ): ?>
                                                            <?php if( $team_1_group['themeum_formation1'] != '' ): ?>
                                                                <?php echo $team_1_group['themeum_formation1']; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-2 vs">
                                                <span> VS </span>
                                            </div>

                                            <div class="col-xs-12 col-sm-5">
                                                <div class="matech-details-team media text-right">
                                                    <div class="pull-right">
                                                    <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_2_group['themeum_club_name2']); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                    <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?></h4>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                        <span>
                                                        <?php if( isset($team_2_group['themeum_formation2']) ): ?>
                                                            <?php if( $team_2_group['themeum_formation2'] != '' ): ?>
                                                                <?php echo $team_2_group['themeum_formation2']; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  <!--row-->     

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="match-status-info clearfix">
                                                    <div class="match-goal-info text-center clearfix">
                                                        <div class="text-center clearfix">
                                                            <ul class="pull-left text-left">
                                                                <?php
                                                                if(is_array($goal_timing_group)){
                                                                    foreach ($goal_timing_group as $value){
                                                                        if (isset($value['themeum_select_team'])) {
                                                                            if($value['themeum_select_team'] == 'value1'){
                                                                                $player_name = themeum_get_title_by_id($value['themeum_goal_player']);
                                                                                if( $value['themeum_goal_player'] != '' ){
                                                                                    echo "<li>".$player_name." ".$value['themeum_time_of_goal']."'</li>";
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                            <span class="status">Goal</span>
                                                            <ul class="pull-right text-right">
                                                                <?php
                                                                if(is_array($goal_timing_group)){
                                                                    foreach ($goal_timing_group as $value){
                                                                        if (isset($value['themeum_select_team'])) {
                                                                            if($value['themeum_select_team'] == 'value2'){
                                                                                $player_name = themeum_get_title_by_id($value['themeum_goal_player']);
                                                                                if( $value['themeum_goal_player'] != '' ){
                                                                                    echo "<li>".$player_name." ".$value['themeum_time_of_goal']."'</li>";
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="match-status-list clearfix">
                                                        <ul>
                                                            <?php 
                                                            if(is_array($match_result_group)){
                                                                foreach ($match_result_group as $value) {
                                                                    if(isset($value['themeum_team1_data'])){
                                                                        $thmselect = '';
                                                                        if (isset($value['themeum_select'])) {
                                                                            $thmselect = $value['themeum_select'];
                                                                        }
                                                                    echo '<li class="clearfix text-center"><span class="count pull-left">'.$value['themeum_team1_data'].'</span><span class="status">'.$thmselect.'</span> <span class="count pull-right">'.$value['themeum_team2_data'].'</span></li>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div> <!--match-status-info-->  
                                            </div> <!--col-xs-12-->   
                                        </div> <!--row-->

                                    </div>  <!--match-status-->                       
                                </div> <!--match-status-->   


                                <div role="tabpanel" class="tab-pane fade" id="timeline">
                                    <div class="match-timeline">
                                        <?php 
                                        if(is_array($match_timeline)){
                                            foreach ($match_timeline as $value){
                                                if(isset($value['themeum_timeline_time'])){
                                                    if(isset($value['themeum_player'])){
                                                        $player_name = '';
                                                        if($value['themeum_player'] != ''){ 
                                                            $player_name = themeum_get_title_by_id($value['themeum_player']); 
                                                        }
                                                    }
                                                    echo '<div class="row">';
                                                        echo '<div class="match-timeline-inner clearfix">';
                                                            echo '<div class="col-xs-3 col-sm-2 time">'.$value['themeum_timeline_time'].'<sub>'.__('min','themeum-soccer').'</sub></div>';
                                                            if(isset($value['themeum_select'])){
                                                                echo '<div class="col-xs-6 col-sm-9 status">'.$value['themeum_select'].' <span>'.$player_name.'</span></div>';
                                                            }
                                                            echo '<div class="col-xs-3 col-sm-1 match-status-icon '.themeum_class_name($value["themeum_select"]).'"></div>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                        ?>                                                               
                                    </div>
                                </div> <!--timeline-->   


                                <div role="tabpanel" class="tab-pane fade" id="team">
                                    <div class="match-team">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="matech-details-team media">
                                                    <div class="pull-left">
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_1_group['themeum_club_name1']); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?></h4>
                                                        <?php endif; ?>
                                                        <span>
                                                            <?php if( $team_1_group['themeum_formation1'] != '' ): ?>
                                                                <?php echo $team_1_group['themeum_formation1']; ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="matech-details-team media text-right">
                                                    <div class="pull-right">
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_2_group['themeum_club_name2']); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?></h4>
                                                        <?php endif; ?>
                                                        <span>
                                                            <?php if( $team_2_group['themeum_formation2'] != '' ): ?>
                                                                <?php echo $team_2_group['themeum_formation2']; ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--row-->      

                                        <div class="match-teams clearfix">
                                            
                                        <?php  
                                        $total_count = 0;
                                        $playlist1 = $playlist2 = $team1data = $team2data = array();
                                        if(isset($team_1_group['themeum_player_list1'])){
                                            $playlist1 = $team_1_group['themeum_player_list1'];
                                            $team1data = themeum_player_info($playlist1);
                                            $total_count = count($playlist1);
                                        }

                                        if(isset($team_2_group['themeum_player_list2'])){
                                            $playlist2 = $team_2_group['themeum_player_list2'];
                                            $team2data = themeum_player_info($playlist2);
                                            if( count($playlist2)> $total_count ){
                                                $total_count = count($playlist2);
                                            }
                                        }

                                        
                                        for ($i=0; $i<$total_count ; $i++){ 
                                            echo '<div class="row match-team-inner">';
                                                echo '<div class="col-xs-12 col-sm-6">';
                                                    echo '<div class="team-overlay clearfix">';
                                                        if(isset($team1data[$i]['image'])){ 
                                                            if( $team1data[$i]['image'] != '' ){
                                                                echo '<img width="40" class="left" src="'.$team1data[$i]['image'].'" alt="'.__('image','themeum-soccer').'">';
                                                            }else{
                                                                echo '<img class="left" src="'.get_template_directory_uri().'/images/team-small.png" alt="'.__('image','themeum-soccer').'">';
                                                            }
                                                        }
                                                        if(isset($team1data[$i]['name'])){ 
                                                            echo '<h4>';
                                                                echo $team1data[$i]['name']; 
                                                            echo '</h4>';
                                                        }
                                                        if(isset($team1data[$i])){
                                                            echo '<div class="player-overlay">';
                                                               echo '<div class="team-overlay-inner">';
                                                                    echo '<div class="player-image-wrap">';
                                                                        if(isset($team1data[$i]['fullimage'])){ 
                                                                            if( $team1data[$i]['fullimage'] != '' ){
                                                                                echo '<img src="'.$team1data[$i]['fullimage'].'" alt="'.__('image','themeum-soccer').'">';
                                                                            }else{
                                                                                echo '<img class="left" src="'.get_template_directory_uri().'/images/team-small.png" alt="'.__('image','themeum-soccer').'">';
                                                                            }
                                                                        }else{
                                                                            echo '<img class="left" src="'.get_template_directory_uri().'/images/team-small.png" alt="'.__('image','themeum-soccer').'">';
                                                                        }
                                                                       // echo '<img src="'.get_template_directory_uri().'/images/palyer-team.png"> ';
                                                                    echo '</div>    ';
                                                                    echo '<div class="player-name-inner">';
                                                                        echo '<h4>';
                                                                            if(isset($team1data[$i]['name'])){ echo $team1data[$i]['name']; }
                                                                        echo '</h4>';
                                                                       echo '<span>';
                                                                            if(isset($team1data[$i]['position'])){ echo $team1data[$i]['position']; }
                                                                       echo '</span>';
                                                                        if(isset($team1data[$i]['url'])){ echo '<div class="more"><a href="'.$team1data[$i]["url"].'"><i class="fa fa-long-arrow-right"></i></a></div>'; }
                                                                        else{ echo '<div class="more"><a href="#"><i class="fa fa-long-arrow-right"></i></a></div>'; }
                                                                       
                                                                    echo '</div>';
                                                                    echo '<ul>';
                                                                            if(isset($team1data[$i]['other'])){
                                                                                if(is_array($team1data[$i]['other'])){
                                                                                    foreach ( $team1data[$i]['other'] as $value) {
                                                                                        echo '<li><span class="payer-info">'.$value["themeum_information_level"].':</span><span>'.$value["themeum_information_data"].'</span></li>';
                                                                                    }
                                                                                }
                                                                            }
                                                                   echo '</ul>';
                                                               echo '</div>';
                                                           echo '</div>';
                                                        }
                                                    echo '</div>';
                                                echo '</div>';



                                                echo '<div class="col-xs-12 col-sm-6 text-right">';
                                                    echo '<div class="team-overlay clearfix">';
                                                        echo '<h4>';
                                                            if(isset($team2data[$i]['name'])){ echo $team2data[$i]['name']; }
                                                        echo '</h4>';
                                                        if(isset($team2data[$i]['image'])){ 
                                                            if( $team2data[$i]['image'] != '' ){
                                                                echo '<img width="40" class="right" src="'.$team2data[$i]['image'].'" alt="'.__('image','themeum-soccer').'">';
                                                            }else{
                                                                echo '<img class="right" src="'.get_template_directory_uri().'/images/team-small.png" alt="'.__('image','themeum-soccer').'">';
                                                            }
                                                        }
                                                        //echo '<img class="right" src="'.get_template_directory_uri().'/images/team-small.png">';
                                                           if(isset($team2data[$i])){
                                                               echo '<div class="player-overlay player-overlay-right">';
                                                                   echo '<div class="team-overlay-inner">';
                                                                        echo '<div class="player-image-wrap">';
                                                                            if(isset($team2data[$i]['fullimage'])){ 
                                                                                if( $team2data[$i]['fullimage'] != '' ){
                                                                                    echo '<img src="'.$team2data[$i]['fullimage'].'" alt="'.__('image','themeum-soccer').'">';
                                                                                }else{
                                                                                    echo '<img class="left" src="'.get_template_directory_uri().'/images/team-small.png" alt="'.__('image','themeum-soccer').'">';
                                                                                }
                                                                            }else{
                                                                                echo '<img class="left" src="'.get_template_directory_uri().'/images/team-small.png" alt="'.__('image','themeum-soccer').'">';
                                                                            }
                                                                        echo '</div>';
                                                                        echo '<div class="player-name-inner">';
                                                                            echo '<h4>';
                                                                                if(isset($team2data[$i]['name'])){ echo $team2data[$i]['name']; }
                                                                            echo '</h4>';
                                                                            echo '<span>';
                                                                                if(isset($team2data[$i]['position'])){ echo $team2data[$i]['position']; }
                                                                            echo '</span>';
                                                                            if(isset($team2data[$i]['url'])){ echo '<div class="more"><a href="'.$team2data[$i]["url"].'"><i class="fa fa-long-arrow-right"></i></a></div>'; }
                                                                            else{ echo '<div class="more"><a href="#"><i class="fa fa-long-arrow-right"></i></a></div>'; }
                                                                       echo '</div>';
                                                                       echo '<ul>';
                                                                            if(isset($team2data[$i]['other'])){
                                                                                if(is_array($team2data[$i]['other'])){
                                                                                    foreach ( $team2data[$i]['other'] as $value) {
                                                                                        echo '<li><span class="payer-info">'.$value["themeum_information_level"].':</span><span>'.$value["themeum_information_data"].'</span></li>';
                                                                                    }
                                                                                }
                                                                            }
                                                                       echo '</ul>';
                                                                   echo '</div>';
                                                               echo '</div>';
                                                            }
                                                       echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                                                       
                                        </div>
                                    </div>
                                </div> <!--match team--> 

                                <div role="tabpanel" class="tab-pane fade" id="substitutes">
                                    <div class="match-team-substitues">
                                        
   
                                        <?php 
                                            foreach ($substitutes as $value) {
                                                echo '<div class="match-substitues-inner clearfix">';
                                                    echo '<div class="row">';
                                                    if (isset($value['themeum_timeline_time'])) {
                                                        echo '<div class="col-xs-2 col-sm-2 time">'.$value["themeum_timeline_time"].' <sub>min</sub></div>';
                                                    }
                                                        echo '<div class="col-xs-8 col-sm-8 subs-players">';
                                                            echo '<h4 class="subs-payer-out">'.themeum_get_title_by_id($value["themeum_player_in"]).' in<i class="fa fa-mail-forward"></i></h4>';
                                                            echo '<h4 class="subs-payer-in">'.themeum_get_title_by_id($value["themeum_player_out"]).' out<i class="fa fa-mail-reply"></i></h4>';
                                                        echo '</div>';
                                                        echo '<div class="col-xs-2 col-sm-2 text-right">';
                                                        if (isset($value['themeum_select_team'])) {
                                                            if($value["themeum_select_team"]=="value1"){
                                                                echo '<img width="61" src="'.themeum_logo_url_by_id($team_1_group['themeum_club_name1']).'" alt="'.__('image','themeum-soccer').'">';
                                                            }else{
                                                                echo '<img width="61" src="'.themeum_logo_url_by_id($team_2_group['themeum_club_name2']).'" alt="'.__('image','themeum-soccer').'">';
                                                            }
                                                        }
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            }
                                        ?>

                                    </div>
                                </div> <!--match-team-substitues-->

                                <div role="tabpanel" class="tab-pane fade" id="match_comments">
                                
                                    <div class="match-comments">
                                        <div class="row">
                                            <div class="col-xs-12 match-comment-inner">
        
                                            <?php
                                            if ( comments_open() || get_comments_number() ) {
                                                comments_template();
                                                }
                                            ?>     
                                             </div>                                     

                                        </div>                           
                                    </div>

                                </div> <!--match-comments-->
                            </div>
                        </div>
                
                        <div class="match-discussion-info clearfix">
                            <h3><?php _e('Summary','themeum-soccer'); ?></h3>
                            <div class="match-discussion"><?php the_content(); ?></div> 
                        </div>

                    </div> <!--match-details-inner-->

                </div> <!--container-->
            </div> <!--match-details-->
        </section> <!--/#main-->



<?php endif; ?>

<?php get_footer();