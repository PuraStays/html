<?php
//require_once("PHPMailer_5.2.1/class.phpmailer.php");
//include_once("config.inc.php");
//ini_set('display_errors', '0');
class DB
     {   

/*			 var $host="localhost"; 
			 var $user="root";
			 var $pwd="";
			 var $database="groz-app";
*/
 			 var $host="52.76.246.184"; 
			 var $user="sanghu";
			 var $pwd='sanghu';
			 var $database="purastays";

			 var $conn=NULL;
			 var $result=false;
			 
			 var $websitename = "";
			 var $websiteurl="";
						
			public function _DB()
			{
				if (!$con)
				  {
					die('Could not connect: ' . mysqli_error());
				  }
			}
			public function _query($qry)
			{
				$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
				$result = mysqli_query($this->conn, $qry);	
				mysqli_close($this->conn);
				return $result;
				
			}
			
			public function redirect($url, $permanent = false) 
			{
				if($permanent)
					{
						header('HTTP/1.1 301 Moved Permanently');
					}
					header('Location: '.$url);
					exit();
			}
		#-------- Beginning for select count rows from a table like select count(*) from idea ---------

		public function select_count($qry)
		{
			//return $qry;
//			eg: $qry="select count(*) from  student_attendance where Attendance_Date like '%-08-%' && Enrollment_Number = '269-0007'";
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
			$row = mysqli_fetch_array($result);
			return $row[0];			
		}
		
		#-------- End for select count rows from a table like select count(*) from idea ---------				
		
#-------- End for select count rows from a table like select count(*) from idea ---------				
		

		public function clm_value( $column1, $column2, $table, $value)
		{
			
			$qry="select $column1 from $table where  $column2  = '$value'";
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
				
			$row = mysqli_fetch_array($result);
			return $row[0];						
			//	return $qry;		
		}
		
		public function clm_value_2($col_select, $col_where1, $col_where2, $table, $value1, $value2)
		{
			$qry="select $col_select from $table where  $col_where1 = '$value1' && $col_where2 = '$value2'";
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
			$row = mysqli_fetch_array($result);
			return $row[0];
		}
		public function clm_value_3($col_select, $col_where1, $col_where2, $col_where3, $table, $value1, $value2, $value3)
		{
			$qry="select $col_select from $table where  $col_where1 = '$value1' && $col_where2 = '$value2' && $col_where3 = '$value3'";
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
			$row = mysqli_fetch_array($result);
			return $row[0];
		}	
		public function clm_value_4($col_select, $col_where1, $col_where2, $col_where3, $col_where4, $table, $value1, $value2, $value3, $value4)
		{
		    $qry="select $col_select from $table where  $col_where1 = '$value1' && $col_where2 = '$value2' && $col_where3 = '$value3' && $col_where4 = '$value4'";
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
			$row = mysqli_fetch_array($result);
			return $row[0];
			
		}				
		public function generate_cmb($col_select, $col_where1, $col_where2, $table, $value1, $value2)
		{
			$qry="select $col_select from $table where  $col_where1 = '$value1' && $col_where2 = '$value2'";
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
			
			
			while($row = mysqli_fetch_array($result))
				{
					
					
				}
			$row = mysqli_fetch_array($result);
			return $row[0];
		}
		public function next_id($Id, $table)
		{
			$qry="SELECT $Id, MAX($Id) FROM $table";
			$i=0;
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
			while($rows = mysqli_fetch_array($result))
				{
					$i=1;
					$Id = $rows['MAX('.$Id.')'];
				}	
				if($i==0)
				{
					return("1");
				}
				else
				{
					$Id++;
					return $Id;
				}
		}
	public function _mail($Email_Id, $Name, $Message, $Subject, $Var_Email_Id, $Var_Email_Name,  $Var_Password)
		{
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "ssl";
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 465;
//				$mail->Port = 587;
//				$mail->Port = 25;
				$mail->Encoding = '7bit';
				
				$mail->Username = $Var_Email_Id;
				$mail->Password = $Var_Password;		
				
				$mail->SetFrom($Var_Email_Id, $Var_Email_Name);
				$mail->AddReplyTo($Var_Email_Id, $Var_Email_Name);
				$mail->Subject = $Subject;
				$mail->MsgHTML($Message);
				
				//$mail->AddAddress($Email_Id, $Student_Name);			
				$mail->AddAddress($Email_Id, '$Subject');				
				$result = $mail->Send();
				
				$mail->ClearAllRecipients();
				unset($mail);
				return(result);

		}
	public function count_classes($Id)
		{
			$qry="SELECT * FROM school where Id = '$Id' limit 1";
			$i=0;
			$this->conn = mysqli_connect($this->host, $this->user, $this->pwd , $this->database);
			$result = mysqli_query($this->conn, $qry);	
			
			while($rows = mysqli_fetch_array($result))
				{
					if($rows['Class_Pre_Primary']==1){$i++;}
					if($rows['Class_Nursery']==1){$i++;}
					if($rows['Class_LKG']==1){$i++;}
					if($rows['Class_UKG']==1){$i++;}
					if($rows['Class_I']==1){$i++;}
					if($rows['Class_II']==1){$i++;}
					if($rows['Class_II']==1){$i++;}
					if($rows['Class_IV']==1){$i++;}
					if($rows['Class_V']==1){$i++;}
					if($rows['Class_VI']==1){$i++;}
					if($rows['Class_VII']==1){$i++;}
					if($rows['Class_VIII']==1){$i++;}
					if($rows['Class_IX']==1){$i++;}
					if($rows['Class_X']==1){$i++;}
					if($rows['Class_XI']==1){$i++;}
					if($rows['Class_XII']==1){$i++;}
				}
				return ($i);
		}
		public function my_remove_array_item( $array, $item ) {
				$index = array_search($item, $array);
				if ( $index !== false ) {
					unset( $array[$index] );
				}
				return $array;
			}				
      }
