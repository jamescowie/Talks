<?php
   $this->visit("www.google.com");

   $this->find('css','.some-element');

   $this->find('css','.some-element')->click();

   $this->fillfield('element', 'this is a value');
