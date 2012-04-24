<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Users model, this will takl to the database and such to process user related things...
	 */	
	class UsersModel extends Model
	{
		const AUTHENTICATE_FIELD_ERROR = 1;
		const AUTHENTICATE_INVALID_EMAIL = 2;
		const AUTHENTICATE_FAILED = 3;

		public function authenticate()
		{
			if((isset($_POST['email'], $_POST['password'])) && (!empty($_POST['email'])) && (!empty($_POST['password']))){
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
					// Since theres no hashing going on with the example database its sad we dont need any sha512 or some salts :(
					$result = Factory::db()->query('SELECT email, name, password, admin, lastlogin FROM subscriber WHERE email=? AND password=? LIMIT 1', $_POST['email'], $_POST['password']);

					if($result !== null){
						$_SESSION['user'] = ( object )array_shift($result);

						return ( bool )true;
					}

					return UsersModel::AUTHENTICATE_FAILED;
				}

				return UsersModel::AUTHENTICATE_INVALID_EMAIL;
			}

			return UsersModel::AUTHENTICATE_FIELD_ERROR;
		}
	}