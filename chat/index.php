<?php 
session_start();
include('header.php');
if (empty($_SESSION['login_user'])) {
    header('Location: ../index.php');
}
include ('Chat.php');
$chat = new Chat();

$_SESSION['username'] = "Soporte";
$_SESSION['userid'] = 1;
$chat->updateUserOnline($_SESSION['userid'], 1);
$lastInsertId = $chat->insertUserLoginDetails($_SESSION['userid']);
$_SESSION['login_details_id'] = $lastInsertId;
?>
<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<link href="css/style.css" rel="stylesheet" id="bootstrap-css">
<script src="js/chat.js"></script>
<style>
.modal-dialog {
    width: 400px;
    margin: 30px auto;	
}
</style>
<div>	
	<?php if(isset($_SESSION['userid']) && $_SESSION['userid']) { ?> 	
		<div class="chat">	
			<div id="frame">		
				<div id="sidepanel">
					<div id="profile">
					<?php
					$loggedUser = $chat->getUserDetails($_SESSION['userid']);
					echo '<div class="wrap">';
					$currentSession = '';
					foreach ($loggedUser as $user) {
						$currentSession = $user['current_session'];
						echo '<img id="profile-img" src="userpics/'.$user['avatar'].'" class="online" alt="" />';
						echo  '<p>'.$_SESSION['username'].'</p>';
							echo '<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>';
							echo '<div id="status-options">';
							echo '<ul>';
								echo '<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>';
								echo '<li id="status-away"><span class="status-circle"></span> <p>Ausente</p></li>';
								echo '<li id="status-busy"><span class="status-circle"></span> <p>Ocupado</p></li>';
								echo '<li id="status-offline"><span class="status-circle"></span> <p>Desconectado</p></li>';
							echo '</ul>';
							echo '</div>';
							echo '<div id="expanded">';			
							echo '<a href="logout.php">Salir</a>';
							echo '</div>';
					}
					echo '</div>';
					?>
					</div>
					<div id="contacts">	
					<?php
					echo '<ul>';
					$chatUsers = $chat->chatUsers($_SESSION['userid']);
					foreach ($chatUsers as $user) {
						$status = 'offline';						
						if($user['online']) {
							$status = 'online';
						}
						$activeUser = '';
						if($user['userid'] == $currentSession) {
							$activeUser = "active";
						}
						echo '<li id="'.$user['id'].'" class="contact '.$activeUser.'" data-touserid="'.$user['id'].'" data-tousername="'.$user['user'].'">';
						echo '<div class="wrap">';
						echo '<span id="status_'.$user['id'].'" class="contact-status '.$status.'"></span>';
						echo '<img src="userpics/'.$user['avatar'].'" alt="" />';
						echo '<div class="meta">';
						echo '<p class="name">'.$user['user'].'<span id="unread_'.$user['id'].'" class="unread">'.$chat->getUnreadMessageCount($user['id'], $_SESSION['userid']).'</span></p>';
						echo '<p class="preview"><span id="isTyping_'.$user['id'].'" class="isTyping"></span></p>';
						echo '</div>';
						echo '</div>';
						echo '</li>'; 
					}
					echo '</ul>';
					?>
					</div>
				</div>			
				<div class="content" id="content"> 
					<div class="contact-profile" id="userSection">	
					<?php
					$userDetails = $chat->getUserDetails($currentSession);
					foreach ($userDetails as $user) {										
						echo '<img src="userpics/'.$user['avatar'].'" alt="" />';
							echo '<p>'.$user['user'].'</p>';
					}	
					?>						
					</div>
					<div class="messages" id="conversation">		
					<?php
					echo $chat->getUserChat($_SESSION['userid'], $currentSession);						
					?>
					</div>
					<div class="message-input" id="replySection">				
						<div class="message-input" id="replyContainer">
							<div class="wrap">
								<input type="text" class="chatMessage" id="chatMessage<?php echo $currentSession; ?>" placeholder="Escribe tu mensaje..." />
								<button class="submit chatButton" id="chatButton<?php echo $currentSession; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>	
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<br>
		<br>
		<strong><a href="login.php"><h3>Acceder al Chat</h3></a></strong>		
	<?php } ?>	
</div>	
