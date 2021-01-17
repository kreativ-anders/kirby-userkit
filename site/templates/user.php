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
  <div class="text">
    <?= $page->text()->kt() ?>
  </div>
</main>



    <header>
      <p><i><?= $kirby->user()->email(); ?></i> | Settings</p>
    </header>
    <section>
      <form action="" method="POST">
    
      
        
              New



            <input class="input" type="email" placeholder="Email" disabled>

          
            <button type="submit" disabled>Update&nbsp;<b>(coming soon!)</b></button>
      
        
      </form>
      <br />
      <form action="" method="POST">
     
    
   
              New
   
   
   
            <input class="input" type="password" placeholder="Password" disabled>

    
            <button type="submit" disabled>Update&nbsp;<b>(coming soon!)</b></button>
        
      
      </form>
    </section>
    <footer >
      <a href="user.json" target="_blank">meine Daten als JSON anfordern</a><br />
      <a href="user.csv" target="_blank">meine Daten als CSV anfordern</a>
      <form action="user" method="POST" onsubmit="return confirm('Diese Aktion kann nicht rückgängig gemacht werden! Sind Sie sich sicher, dass der Account gelöscht werden soll?');">
        <div class="buttons">
          <input type="hidden" name="user" value="<?= $kirby->user()->email(); ?>" />
          <input type="submit" name="deleteUser" value="Delete Account" />
        </div>
        
      </form>
      
      
    </footer>



<?php snippet('footer') ?>