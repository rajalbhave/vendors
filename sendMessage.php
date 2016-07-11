<?php 
/* Ajax call to insert message into the databse and update the table*/
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

if($_POST["action"] == 'sendMessage'){
	$message = esc_textarea( $_POST["message"] );
	$delivery_date    = sanitize_text_field( $_POST["delivery_date"] );
	$delivery_date=date("Y-m-d h:i:s",strtotime($delivery_date));
	$user_id = $_POST["user_id"];
	//  echo ' email =  '. $email. ' phone =  '. $phone. ' message =  '. $message;
	 
	

	
	
	function insertMessage( $message,  $delivery_date, $user_id ) {
	  global $wpdb;
	//echo 'message =  '. $message.'date =  '. $delivery_date.'userId =  '. $user_id  ;

	  $table_name = $wpdb->prefix . 'messages';
	  $wpdb->insert( $table_name, array(
		'message_text' => $message,
		'message_delivery_date' => $delivery_date,
		'user_id' => $user_id  
	  ) );
	}



	function getMessages( $user_id ) { 
		  global $wpdb;
		  $table_name = $wpdb->prefix . 'messages';
		 // echo "SELECT * FROM {$table_name} user_id = {$user_id}";
	  
	    
	echo 	'<tr>
			<th>Message</th>
			<th>Delivery Date</th> 
			<th> Status </th>
		</tr>

';
		$results = $wpdb->get_results( "SELECT * FROM {$table_name} where user_id = {$user_id} ORDER BY message_id DESC"  );
		//var_dump($results);
		foreach ($results as $result) {
			// echo $result->message_id.'<br/>';
				$table_html .= '<tr>
				<td >'.  $result->message_text . '</td>';
				$newDate = date("d - M - Y", strtotime($result->message_delivery_date));
				$table_html .=	'<td>'.  $newDate . ' </td>'; 
				if( $result->message_status == 0) $status = "<i class='uk-icon-close message-not-sent' >"; else $status = "<i class='uk-icon-check message-sent' >";
				$table_html .=	'<td> '.  $status . ' </td>
			</tr>
		';


		}	
		echo $table_html;

	}
	
	insertMessage( $message,  $delivery_date, $user_id);
	getMessages( $user_id);
	
	
}


?>