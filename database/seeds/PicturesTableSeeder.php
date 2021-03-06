<?php

use Illuminate\Database\Seeder;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $faker;

    public function __Construct(Faker\Generator $faker)
    {
    	$this->faker =$faker;
    }

    public function run()
    {
        $dirUpload = public_path(env('UPLOAD_PICTURE', 'uploads')); //chemin ou on ajoute des images
		
		$files = File::allFiles($dirUpload); //chemin pr img
		//foreach pour tous suprimer 
		foreach ($files as $file ) File::delete($file);

		$posts = \App\Post::all();

		foreach ($posts as $post)
		{
			$uri = str_random(50). '_370x235.jpg'; //evite les fail de sécuriter ex scritp dans name qui recupairerais les cooquis pr plomber en admin la base de donnée
			$id = rand(0,9);
			$fileName = file_get_contents('http://lorempicsum.com/futurama/370/235/'.$id);
			
			File::put(
				$dirUpload.DIRECTORY_SEPARATOR.$uri, $fileName //on deplace l'image dans ce fichier
				);
		

		$mime = mime_content_type($dirUpload.DIRECTORY_SEPARATOR.$uri);



		\App\Picture::create([
			'post_id'=> $post->id,
			'uri' => $uri,
			'name' => $this->faker->name,
			'mime' => $mime,
			'size' => 200
			]);
}
	}
}
