<?php 

	class Message{
	
		public $id ; 
		public $threadID ; 
		public $receiver ; 
		public $sender ; 
		public $subject ; 
		public $msg ; 
		public $sentDate ; 
		public $property ; 
		public $status ; /*
				0 - unread 
				1 - read
				2 - replyied
		*/
	
		
	
		function __construct($thread , $rec , $send , $subj , $msg ,  $prop  ){
			$this->threadID = $thread ; 
			$this->receiver = $rec ; 
			$this->sender = $send ; 
			$this->subject = $subj ; 
			$this->msg = $msg ; 
		
			$this->property = $prop ; 
			$this->status = 0 ; 
		
			
		}
		
		
	
	}

?>