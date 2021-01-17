<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`. * 
 * This default template must not be removed. It is used whenever Kirby cannot find a template with the name of the content file.
 * Snippets like the header, footer and intro contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>
<?php snippet('header') ?>

<main>

<?php 
  if(isset($error)) {
    echo "Error: " . $error. "<br />";
  }
?>

</main>



    <header >
      <p><?= $page->text()->kt() ?></p>
    </header>
    <form action="signup" method="POST">
      <section>

    
              <input type="email" name="email" value="" placeholder="Email" autocomplete="email" required>

              <p><i style="color: rgba(80,80,80,.5)">Die Email Adresse wird lediglich für die Authentifizierung gespeichert und verwendet.</i> 😬</p>
   

     
              <input type="password" name="password" value="" placeholder="Passwort" required>

              <p><i style="color: rgba(80,80,80,.5)">Einmal das Passwort eingeben sollte ausreichen!?</i></p>
    
  
        
      </section>
      <footer >
        <button name="signup" type="submit" style="border: 2px solid red; padding: 0.5rem; font-weight: bold; margin-top: 1rem;">Signup</button>     
      </footer>
    </form>



<?php snippet('footer') ?>