<?php
	/**
	 * Variable $code value:
	 *
	 * 	=0 Query executed, failed.
	 * 	=1 Query executed, some error occured.
	 * 
	 */
	class QueryException extends Exception{

		private $queryErrorCode;

		public function __constructs($code, $queryErrorCode){

			parent::__constructs($code);
			
			$this->queryErrorCode=$queryErrorCode;

		}
		
	}
?>