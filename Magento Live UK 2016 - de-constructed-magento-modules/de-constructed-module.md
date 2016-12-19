![original](images/intro.jpeg)

---

## [fit] The _**de constructed**_
## [fit] Magento module

![](images/intro.jpeg)

---

### James Cowie
### Technical Team Lead Inviqa
#### t/**@jcowie** gh/**jamescowie**
##### 2016 Magento Master _mover_

![original](images/b2.jpeg)

---

# [fit] deconstruct...

**verb** | de·con·struct \ˌdē-kən-ˈstrəkt\ |

> To take apart or examine in order to reveal the basis or composition of ?often with the intention of exposing biases, flaws, or inconsistencies
-- Wayne Karlin

![original](images/b4.jpeg)

---

# [fit]deconstruction in software

![original](images/b2.jpeg)

---

# The *Law* of Demeter (LoD)

>Or principle of least knowledge is a design guideline for developing software, particularly object-oriented programs. In its general form, the LoD is a specific case of loose coupling. [^1]

[^1]: https://en.wikipedia.org/wiki/Law_of_Demeter

![original](images/b4.jpeg)

---

![](http://ircmaxell.github.io/DontBeStupid-Presentation/assets/images/strangers.jpg)

---

# [fit]What is **de**coupled code ?

![original](images/b2.jpeg)

---

**Tight coupling**

Tight coupling is when a group of classes are highly dependent on one another. This scenario arises when a class assumes too many responsibilities, or when one concern is spread over many classes rather than having its own class.[^10]

![original](images/b4.jpeg)

[^10]: https://en.wikipedia.org/wiki/Coupling_(computer_programming)

---

**Loose coupling**

Loosely coupled code is where each of a systems modules has, or makes use of, little or no knowledge of the definitions of other separate modules[^11]

![original](images/b4.jpeg)

[^11]: https://en.wikipedia.org/wiki/Loose_coupling

---

**High Cohesion**

 Modules with high cohesion tend to be preferable, because high cohesion is associated with several desirable traits of software including robustness, reliability, reusability, and understandability. [^3]

![original](images/b4.jpeg)

[^3]: https://en.wikipedia.org/wiki/Cohesion_(computer_science)

---

**Low Cohesion**

In contrast, low cohesion is associated with undesirable traits such as being difficult to maintain, test, reuse, or even understand.[^13]

![original](images/b4.jpeg)

[^13]: https://en.wikipedia.org/wiki/Cohesion_(computer_science)

---

## **D**on't **R**epeat **Y**ourself[^⌘]

[^⌘]: Cut: Command ⌘ - x, Copy: Command ⌘ - c, Paste: Command ⌘ - v



![](http://c.fastcompany.net/multisite_files/coexist/article_feature/1280-dry-land-farming.jpg)

---

# [fit] Traits

![original](images/b4.jpeg)

^ Oh wait, then the language authors and fellow programmers go and provide another way to misrepresent reuse and tempt us into thinking we are following DRY principles. This is closer but can provide a false sense of accomplishment.

---

# [fit] Composition

![original](images/b4.jpeg)

^ Throughout Magento 1 development the main way to develop was to use Inheritance over Composition. We had to do this for many reasons, No concrete way to inject dependencies etc etc. But as we have evolved we know we should favour Composition over Inheritache so what is composition ? When we talk about inheritance we tend to use " Is a " relationship. My class "Is a" database class. However with composition lets start talking about our code as "Has a" or "Uses a", We can then start to de couple the creation of objects and services from the classes that are useing some part of them. E.g. This UserSignup class "Uses" the database. We are composing out objects of all the ingredients that is required to make the work.

---

# ⎏
# [fit] Interfaces
![original](images/b4.jpeg)

---

# Code Time
#### Create an out of stock command that emails store admin using Mandrill because that never changes does it :)

![original](images/b4.jpeg)

---

![original](images/b7.jpeg)

```php
<?php namespace MLUK\Emailer\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class EmailCommand extends Command
{
    protected function configure()
    {
        $this->setName('MLUK:email');
        $this->setDescription('Send all email out to people about how much stock is remaining');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $emailer = new Mandrill('SOMEAPIKEY');

        $message = array(
            'subject' => 'Out of stock email',
            'from_email' => 'you@yourdomain.com',
            'html' => '<p>You are being notified about product stock information!.</p>',
            'to' => array(array('email' => 'recipient1@domain.com', 'name' => 'Recipient 1')),
            'merge_vars' => array(array(
                'rcpt' => 'recipient1@domain.com',
                'vars' =>
                    array(
                        array(
                            'name' => 'FIRSTNAME',
                            'content' => 'Recipient 1 first name'),
                        array(
                            'name' => 'LASTNAME',
                            'content' => 'Last name')
                    ))));

        $template_name = 'Products';

        // load all products
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');

        $collection = $productCollection->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('stock_status', 0)
            ->load();

        $productHtml = '';

        foreach ($collection as $product) {
            $productHtml .= '<p>' . $product->getName() . '</p>';
        }

        $template_content = array(
            array(
                'name' => 'main',
                'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*, thanks for signing up.'),
            array(
                'name' => 'footer',
                'content' => 'Copyright 2016.')

        );

        $emailer->messages->sendTemplate($template_name, $template_content, $message);

        $output->writeln("Email is sent for out of stock products");
    }
}
```
---

![](images/myeyes.jpg)

---

![original](images/b7.jpeg)

```php
class EmailCommand extends Command
{
  protected function configure() { .. }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
  ...
  }
}
```

---
![original](images/b7.jpeg)

```php
...
$emailer = new Mandrill('SOMEAPIKEY');

$message = array(
  'subject' => 'Out of stock email',
  'from_email' => 'you@yourdomain.com',
  'html' => '<p>You are being notified about product stock information!.</p>',
  'to' => array(array('email' => 'recipient1@domain.com', 'name' => 'Recipient 1')),
  'merge_vars' => array(array(
  'rcpt' => 'recipient1@domain.com',
  'vars' =>
    array(
        array(
            'name' => 'FIRSTNAME',
            'content' => 'Recipient 1 first name'),
        array(
            'name' => 'LASTNAME',
            'content' => 'Last name')
))));

$template_name = 'Products';
...
```

---
![original](images/b7.jpeg)

```php
...
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

$productCollection = $objectManager->create(
  'Magento\Catalog\Model\ResourceModel\Product\CollectionFactory'
);

$collection = $productCollection->create()
    ->addAttributeToSelect('*')
    ->addAttributeToFilter('stock_status', 0)
    ->load();

$productHtml = '';

foreach ($collection as $product) {
    $productHtml .= '<p>' . $product->getName() . '</p>';
}
...
```

---
![original](images/b7.jpeg)

```php
...
$template_content = array(
    array(
        'name' => 'main',
        'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*.'),
    array(
        'name' => 'footer',
        'content' => 'Copyright 2016.')

);

$emailer->messages->sendTemplate(
  $template_name, $template_content, $message
);

$output->writeln("Email is sent for out of stock products");
```
---

![](images/tryharder.jpg)

---
![original](images/b4.jpeg)

# Attempt 1
   - All logic enclosed in a single method
   - No reuse
   - Hard to understand
   - Hard to change

---
![original](images/b4.jpeg)

# Issues with the class
   - Fragility
   - Cost of change
   - Technical debt

---
![original](images/b4.jpeg)

# Fragility
   - No tests
   - Mixed business logic and framework

---
![original](images/b4.jpeg)

# Cost of change
   - Email may be used throughout the app
   - Hard to understand
   - Becomes "*That class*"


---
![original](images/b4.jpeg)

# Technical debt
   - Cost of code over time
   - Impact on speed of change

---
![original](images/b4.jpeg)

# What is our method actually doing ?
   - Building vars for email sending
   - Getting all products that are out of stock
   - Sending the email


---

![fit](images/refactor.jpg)

---
![original](images/b4.jpeg)

EmailCommand.php
# *Becomes*
   - Model/Emailer.php
   - Model/OutOfStockProducts.php
   - Commands/EmailCommand.php

---
![original](images/b4.jpeg)

# Model for Emailer

```php
namespace MLUK\BetterEmailer\Model;

class Emailer
{
  public function setTemplate(array $templateData)
  { ... }

  public function sendEmail($ApiKey, $templateName, $templateContent, $message)
  { ... }
}
```

---
![original](images/b4.jpeg)

# Model for OOS products

```php
namespace MLUK\BetterEmailer\Model;

class OutOfStockProducts
{
  public function getOutOfStockProducts()
  { ... }
}
```
---
![original](images/b4.jpeg)

#Emailer Command

```php
<?php namespace MLUK\BetterEmailer\Commands;
...

class EmailCommand extends Command
{
    protected function configure()
    { ... }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $products = new \MLUK\BetterEmailer\Model\OutOfStockProducts();
        $emailer = new \MLUK\BetterEmailer\Model\Emailer();

        $emailTemplate = $emailer->setTemplate(['name' => 'james', 'lastname' => 'cowie', ]);
        $emailer->sendEmail(
          'KEY','products',$emailTemplate, $products->getOutOfStockProducts()
        );

        $output->writeln("Email has been sent");
    }
}
```

---
![original](images/b4.jpeg)

# Getting better
   - Separate class and methods
      - Easier to test
      - Easier to understand
      - Extracted from the framework

---

![fit](images/great.jpg)

---
![original](images/b4.jpeg)

# Attempt 3
   - Interfaces
   - Dependency Injection   

---
![original](images/b4.jpeg)

# Interfaces *AKA* Service Contracts


```php
<?php

interface Emailer
{
    public function send($templateName, $templateContent, $message);
    public function setVariables(array $templateData);
}
```

---
![original](images/b4.jpeg)

# Why are interfaces important ?
   - Contract for other developers to follow
   - Aid in testing
   - Backwards Compatibility breaks
   - Type safe checking

---
![original](images/b4.jpeg)

#SOLID[^1]

*S* – Single-responsiblity principle
*O* – Open-closed principle
*L* – Liskov substitution principle
*I* – Interface segregation principle
*D* – Dependency Inversion Principle

[^1]:Robert C. Martin

---
![original](images/b4.jpeg)

#S*O*LID

*O* – Open-closed principle

`This simply means that a class should be easily extendable without modifying the class itself`

---
![original](images/b4.jpeg)

# Implement our Interfaces
####  "Model/Emailers/Mandrill.php"
```php
<?php namespace MLUK\ImprovedEmailer\Model\Emailers;

use MLUK\ImprovedEmailer\Api\EmailerInterface;

class Mandrill implements EmailerInterface
{
    public function setVariables(array $templateData)
    { ... }

    public function send($templateName, $templateContent, $message)
    { ... }
}

```

---
![original](images/b4.jpeg)

# Back to our command

```php
/** @var \MLUK\ImprovedEmailer\Api\EmailerInterface  */
protected $emailer;

/** @var OutOfStockProducts  */
protected $outOfStockProducts;

public function __construct(
  \MLUK\ImprovedEmailer\Api\EmailerInterface $emailer,
  OutOfStockProducts $ofStockProducts
)
{
   $this->emailer = $emailer;
   $this->outOfStockProducts = $ofStockProducts;
   parent::__construct('ImprovedEmail');
}
```

---
![original](images/b4.jpeg)

# [fit] Injecting an interface ?

### Trust me just go with it :)

---
![original](images/b4.jpeg)

# [fit] Executing our command
```php
protected function execute(InputInterface $input,
  OutputInterface $output)
{
    $templateVars = $this->emailer->setVariables(['name', 'james']);
    $this->emailer->send(
      'Products',
      $templateVars,
      $this->outOfStockProducts->getOutOfStockProducts()
    );
}
```

---
![original](images/b4.jpeg)

# Welcome di.xml

```xml
<config>
  <preference
    for="MLUK\ImprovedEmailer\Api\EmailerInterface"
    type="MLUK\ImprovedEmailer\Model\Emailers\Mandrill"
  />
</config>
```
---

![original](images/b4.jpeg)

#SOLI*D*

*D* - Dependency Inversion principle

`Entities must depend on abstractions not on concretions. It states that the high level module must not depend on the low level module, but they should depend on abstractions.`

---
![original](images/b4.jpeg)

# [fit] Mandrill changes its pricing and we
# [fit] want to change implementation quick ?

   - Create a new Emailer client
   - Update di.xml

---
![original](images/b4.jpeg)

# PHPClient
```php
<?php namespace MLUK\ImprovedEmailer\Model\Emailers;

use MLUK\ImprovedEmailer\Api\EmailerInterface;

class PHPClient implements EmailerInterface
{
    public function send($templateName, $templateContent, $message)
    {
        return mail($templateContent['email'], $templateContent['subject'], $message);
    }

    public function setVariables(array $templateData)
    {
        return [
            'name' => $templateData['name'],
            'email' => $templateData['email'],
            'subject' => $templateData['subject']
        ];
    }
}

```

---
![original](images/b4.jpeg)

#Update di.xml


```xml
</config>
  <preference
    for="MLUK\ImprovedEmailer\Api\EmailerInterface"
    type="MLUK\ImprovedEmailer\Model\Emailers\PHPClient"
  />
</config>
```

---
![original](images/b4.jpeg)

# Why would we do this ?

   - Each class now does a single thing well
   - Each class is easier to test
   - Interfaces enforce a common public Api
   - DI allows dependencies to be mocked and made visible

---
![original](images/b4.jpeg)

# Where else can we see this ?
   - Magento 2 Core
   - Hexagonal Architecture
   - DDD ( Domain Driven Design )

---
![original](images/b4.jpeg)

#[fit] *Disclaimer*
### Not **all** Magento 2 core implements service contracts *yet*

---
![original](images/b4.jpeg)

# Customer

```php
interface CustomerInterface {
   public function getId();
   public function setId($id);
   public function getGroupId();
   public function setGroupId($groupId);
   .....
}
```
---
![original](images/b4.jpeg)

# Customer di.xml
```xml
<config>
  ...
  <preference
    for="Magento\Customer\Api\Data\CustomerInterface"
    type="Magento\Customer\Model\Data\Customer"
  />
  ...
</config>
```
---
![original](images/b4.jpeg)

# So to use Customer

```php
protected $customer;

public function __construct(
   \Magento\Customer\Api\Data\CustomerInterface $customer
)
{
    $this->customer = $customer;
}

public function doSomething()
{
    echo $customer->getName();
}
```
---
![original](images/b4.jpeg)

# Recap on Interfaces
   - Should never change between major versions
   - They are still *WIP* in Magento 2
   - If there is a interface use it!!

---
![original](images/b4.jpeg)

#Recap on Dependency Injection
   - Inject interfaces where available
   - Use DI over ObjectManager
   - Generate DI in production mode

---
![original](images/b4.jpeg)

# Source Code

[https://github.com/jamescowie/magetitansmini-example](https://github.com/jamescowie/magetitansmini-example)

---
![original](images/b4.jpeg)

# Thank you
## Any questions ?

#### t/**@jcowie**
#### Email/**james@mage.school**
