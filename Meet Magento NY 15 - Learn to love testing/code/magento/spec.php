<?php

function it_should_greet_non_logged_in_users_with_a_generic_message()
{
  $this->greet()->shouldReturn('Hello guest, Please register with us for special offers');
}
