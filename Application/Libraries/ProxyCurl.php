<?php 

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 5th February 2012
	 *
	 * This class is used to just proxy through a URL, its purpose was to obtain the 
	 * images for the holidays using Javascript
	 */	
	class ProxyCurl
	{

		/**
		*  
		*
		* @static
		* @param string $url
		* @return string
		*/
		public static function get($url)
		{
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
			));		
				
			$data = curl_exec($curl);
			curl_close($curl);

			return $data;
		}
	}