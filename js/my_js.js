
//Function To Display Popup
function div_show() {
document.getElementById('abc').style.display = "block";
}
//Function to Hide Popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}
function check1()
			{

				document.getElementById("co1").color = "green";
				document.getElementById("b1").innerHTML = "Enter Username"
				document.getElementById("b2").innerHTML = "";

			}
function check2()
			{
				document.getElementById("co2").color = "green";
				document.getElementById("b2").innerHTML = "Enter your email";

				var d3 = document.form.name.value;
				if(d3=="")
				{
					document.getElementById("b1").innerHTML = "User name can not be empty";
					document.getElementById("co1").color = "red";
				}
				


			}

function check3()
			{

				document.getElementById("co3").color = "green";
				document.getElementById("b3").innerHTML = "Enter your message";
				
				var d1 = document.form.name.value;
				var d2 = document.form.email.value;
				if(d1=="")
				{
					document.getElementById("co1").color = "red";
					document.getElementById("b1").innerHTML = "Username can not be empty";

				}

				if(d2=="")
				{
					document.getElementById("co2").color = "red";
					document.getElementById("b2").innerHTML = "Password can not be empty";
				}
				
			}
			
			function check4()
			{

				document.getElementById("co3").color = "green";
				document.getElementById("b3").innerHTML = "Enter your message";
				
				var d1 = document.form.name.value;
				var d2 = document.form.email.value;
				var d3 = document.form.message.value;
				if(d1=="")
				{
					document.getElementById("co1").color = "red";
					document.getElementById("b1").innerHTML = "Username can not be empty";

				}

				if(d2=="")
				{
					document.getElementById("co2").color = "red";
					document.getElementById("b2").innerHTML = "Password can not be empty";
				}
				
				if(d3=="")
				{
					document.getElementById("co3").color = "red";
					document.getElementById("b3").innerHTML = "message can not be empty";
				}
				else
				{
					document.getElementById('abc').style.display = "none";
					swal("Thank You!", "Your information is saved!", "success")
					
				}
			}
