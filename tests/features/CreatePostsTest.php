<?php


class CreatePostsTest extends FeatureTestCase
{
    public function test_a_user_create_a_post()
    {
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';
        //Dexcribimos los pasos a realizar, ir a ruta ,grabar datos en base de datos segun tipo, y pulsar publicar
        $this->actingAs($this->defaultUser());
        
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');

        //Resultado que debe guardarse en base de datos
        $this->seeInDatabase('posts', [
           'title' =>  $title,
            'content' => $content,
            'pending' => true,
        ]);

        //Comprobamos que se redirige bien a la salida, y en elemento h1 vemos la frase
        $this->seeInElement('h1', $title);
    }
}