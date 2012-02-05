<?php 

	class ProxyCurl
	{
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