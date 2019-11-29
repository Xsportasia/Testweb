<?php



/*
// Add Menu in admin panel
function themeum_admin_menu(){
		add_submenu_page( __( 'Withdraw', 'startup' ), __( 'Withdraw', 'startup' ), 'administrator', 'themeum_startup_idea_withdraw', 'themeum_startup_idea_withdraw' );
	}
add_action( 'admin_menu', 'themeum_admin_menu' );
*/

add_action( 'admin_menu', 'register_poll_menu_page' );

function register_poll_menu_page(){
	add_submenu_page(  'edit.php?post_type=poll', __('Poll Reasult','themeum-poll' ), __('Poll Reasult','themeum-poll' ), 'manage_options', 'themeum-poll', 'themeum_poll_menu_page', '' , 6 ); 
//add_submenu_page( 'edit.php?post_type=course', __( 'All Orders', 'themeum-lms' ), __( 'All Orders', 'themeum-lms' ), 'administrator', 'edit.php?post_type=lmsorder' );
}






function themeum_poll_menu_page(){
	?>
		<h1><?php _e('Poll Result','themeum-poll') ?></h1>
		<?php 
			global $wpdb;

			$range = 20;
			$limit = 'LIMIT 0,'.$range;
			if(isset($_GET['limit'])){
				if($_GET['limit']){
					$all = $range*$_GET['limit'];

					$limit = 'LIMIT '.( $all - $range ).', '.$all.' ';
				}
			}
			//$result = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM " . $wpdb->prefix . "postmeta WHERE meta_key='%s' AND meta_value='%s' $limit",'thm_withdraw_request','yes'));
		 

		 	global $post;
		    $args = array(
		        'post_type'         => 'poll',
		        'post_status'       => 'publish',
		        'posts_per_page'    => -1
		    );
		    $posts = get_posts($args);

		    $result = array();
		    foreach ($posts as $post){

		    	setup_postdata( $post );
		    	$poll_question      = rwmb_meta('themeum_poll_question');
		    	

		    	$percent_data = array();
		    	$percent_title = array();
		    	$total_poll = 0;
                foreach($poll_question as $value){
                    $reasult = get_post_meta( get_the_ID() , $value , true );
                    if($reasult == ''){ $reasult = 0; }
                    $total_poll = $total_poll + intval($reasult);
                    $percent_data[] = $reasult;
                    $percent_title[] = $value;
                }

                $final_percen = array();
                if(is_array($percent_data)){
                	foreach($percent_data as $value){
                    	$final_percen[] = (($value/$total_poll)*100);
                	}

                	
                	foreach($final_percen as $value) {
                		$i=0;
                		foreach ($final_percen as $key) {
	                		if(isset($final_percen[$i+1])){
	                			if( $final_percen[$i]<$final_percen[$i+1] ){
	                				$temp = $final_percen[$i];
	                				$temp2 = $percent_title[$i];
	                				$final_percen[$i] = $final_percen[$i+1];
	                				$percent_title[$i] = $percent_title[$i+1];
	                				$final_percen[$i+1] = $temp;
	                				$percent_title[$i+1] = $temp2;
	                			}
	                			
	                		}
	                		$i++;
                		}
                		
                	}	
                }



                //rsort($final_percen);
               
                //print_r($final_percen);

                $arr['name'] 		= get_the_title();
                $arr['participant'] = $total_poll;
                
                if(isset($final_percen[0])){ $arr['first'] = substr($final_percen[0], 0, 5); }
                if(isset($final_percen[1])){ $arr['second'] = substr($final_percen[1], 0, 5); }
                if(isset($final_percen[2])){ $arr['third'] = substr($final_percen[2], 0, 5); }

                if(isset($percent_title[0])){ $arr['first_name'] = $percent_title[0]; }
                if(isset($percent_title[1])){ $arr['second_name'] = $percent_title[1]; }
                if(isset($percent_title[2])){ $arr['third_name'] = $percent_title[2]; }

		    	$result[] = $arr;
		    }
			


		 ?>

		<table class="wp-list-table widefat fixed posts">
			<thead>
			<tr>
				<td><?php _e('Poll Name','themeum-poll') ?></td>
				<td><?php _e('Total Participant','themeum-poll') ?></td>
				<td><?php _e('First Poll','themeum-poll') ?></td>
				<td><?php _e('Second Poll','themeum-poll') ?></td>
				<td><?php _e('Third Poll','themeum-poll') ?></td>
			</tr>
			</thead>
			<tbody>
				 <?php 
					if(is_array($result)){
						
						foreach ($result as $value){
							
							echo '<tr>';
								echo '<td>'.$value["name"].'</td>';
								echo '<td>'.$value["participant"].'</td>';
								echo '<td>'.$value["first_name"].' ('.$value["first"].'%)</td>';
								echo '<td>'.$value["second_name"].' ('.$value["second"].'%)</td>';
								echo '<td>'.$value["third_name"].' ('.$value["third"].'%)</td>';
							echo '</tr>';

						}
						
					}
				 ?>
			</tbody>
		</table>
		<?php 


		$results = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM " . $wpdb->prefix . "postmeta WHERE meta_key='%s' AND meta_value='%s'",'thm_withdraw_request','yes'));
		$loop = ceil(count($results)/$range);
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$actual_link = explode('&limit=',$actual_link);
		echo '<div class="tablenav"><div class="tablenav-pages"><span class="pagination-links">';
			for ($i=1; $i <= $loop; $i++) { 
				if( isset($_GET['limit']) ){
					if($i == $_GET['limit']){
						echo '<a class="actives" href="'.$actual_link[0].'&limit='.$i.'">'.$i.'</a>';
					}else{
						echo '<a href="'.$actual_link[0].'&limit='.$i.'">'.$i.'</a>';	
					}
				}else{
					if($i == 1){
						echo '<a class="actives" href="'.$actual_link[0].'&limit='.$i.'">'.$i.'</a>';
					}else{
						echo '<a href="'.$actual_link[0].'&limit='.$i.'">'.$i.'</a>';
					}
						
				}
			}
		echo '</span></div></div>';
}