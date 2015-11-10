
![original](images/M2_BG-Cover-B.png)

---

## [fit] The _**HOW**_
## [fit] & _**WHY**_
## of composable Magento

![original](images/AS-black-bg.png)

---

### James Cowie
### Technical Team Lead Session Digital
#### t/**@jcowie** gh/**jamescowie**

### Alistair Stead
### CTO Session Digital
#### t/**@alistairstead** gh/**alistairstead**

![original](images/AS-blue-bg.png)

---

# [fit] Reuse...

![](images/AS-white-bg.png)

**verb** |riːˈjuːz| _[ with obj. ]_
use again or more than once: the tape could be magnetically erased and reused.

**noun** |riːˈjuːs| _[ mass noun ]_
the action of using something again: the ballast was cleaned ready for reuse.

^ What is reuse? Programmers are taught this from day one. This is a watchword for everything that drives our industry. Write code so it can be re-used re-purposed. This is why we have modular patterns, inheritance, extension points. This drives the idea of don't repeat yourself. In fact I have been heard to state many times both in public to any audience that would listen to me, and privately that I would rather hire a lazy engineer than one prepared to merrily keep typing and building the same features over and over and over...

^ Is reuse a myth? A fallacy driven from misunderstanding or the principles by which DRY was defined? A big industry misunderstanding?

---

# **D**on't **R**epeat **Y**ourself[^⌘]

[^⌘]: Cut: Command ⌘ - x, Copy: Command ⌘ - c, Paste: Command ⌘ - v

![](http://c.fastcompany.net/multisite_files/coexist/article_feature/1280-dry-land-farming.jpg)

^ DRY is not about simplistic code duplication. It is about duplication of knowledge and intent.

---

> “Every piece of knowledge should have one and only one representation.”
-- Dave Thomas and Andy Hunt

![](images/AS-white-bg.png)

^ This is the most subtle of principles. We tend to think of duplication at a code level — a mechanical “this looks like that, so duplication!” level. However, this guiding principle isn’t about code duplication; it is about knowledge duplication.

^ A lot of people are introduced to this idea through the DRY principle, or Don’t Repeat Yourself. This was established in the book, The Pragmatic Programmer, by Dave Thomas and Andy Hunt.

^ The DRY principle states “Every piece of knowledge should have one and only one representation.” This rule also has been expressed as “Once and Only Once.” http://pragprog.com/book/tpp/the-pragmatic-programmer

^ Instead of looking for code duplication, always ask yourself whether or not the duplication you see is an example of core knowledge in the system.

---

# [fit] Inheritance

![](images/inheritance.jpg)

^ Inheritance, objects and the promised land of reuse...

^ Inheritance gives us reuse... It lets us use fewer key strokes in order to be share behavior between objects. But this type of reuse is lying to you. Inheritance creates tight coupling and eventually limits the scope to which you can reuse your beautifully crafted code.

---

# [fit] Traits *_&_* Mixins?

![](images/cocktail.jpg)

^ Oh wait, then the language authors and fellow programmers go and provide another way to misrepresent reuse and tempt us into thinking we are following DRY principles. This is closer but can provide a false sense of accomplishment.

---

# [fit] Composition

![](images/bricks.png)

^ Throughout Magento 1 development the main way to develop was to use Inheritance over Composition. We had to do this for many reasons, No concrete way to inject dependencies etc etc. But as we have evolved we know we should favour Composition over Inheritache so what is composition ? When we talk about inheritance we tend to use " Is a " relationship. My class "Is a" database class. However with composition lets start talking about our code as "Has a" or "Uses a", We can then start to de couple the creation of objects and services from the classes that are useing some part of them. E.g. This UserSignup class "Uses" the database. We are composing out objects of all the ingredients that is required to make the work.

---

# ⎏
# [fit] Interfaces

![](images/interfaces.jpg)

---

# [fit] Modules for reuse

![](images/lego.jpg)

^ We have modules for reuse but it is only reuse within the context of Magento and at that only reuse with Magento as of the major version when you wrote the module.

---

![original](images/AS-yellow-bg.png)

# ![200%](images/m-connect.png)

^ Magento has always (almost always) been extensible through modular code reuse. The connect marketplace had a higher purpose but it meant that Magento allowed modular code reuse.

^ Though to be honest not many development teams seemed to use it extensively. We all know first had the issues connect had and by design its ease of use for non developers to install from was not ideal. But lets not forget that at least the tought process was in place to allow us to think about how packages created for Magento could be re used in other projects.

---

![](images/AS-white-bg.png)


# ![200%](images/pear.png)

^ It was based on the PHP library repository technology of the time PEAR but restricted the use to the Magento repository for installs. Using the wider community of PEAR packages was problematic and there was nothing but legacy code in the PEAR channels.

---

![](images/AS-white-bg.png)

# `modman`

^ Thanks to Colin Mollenhour we got modman and we could begin to script and compose our modular application dependencies. However at this time this was a shim to installing just the connect modules packaged with PEAR.

^ Over time Modman allowed us to take individual modules and put them in there own source control system and use modman to link them into a Magento 1 install. For a series of bash scripts this worked really really well and is still in use for many projects today. 

---

# [fit] Composer ![inline](https://getcomposer.org/img/logo-composer-transparent3.png)

![](images/packagist.png)

^ in 2011 Jordi Boggiano started out on creating a solution for the PHP community. His goal was to have a reliable package manager for PHP so anyone could create packages that could be used in any project. Composer was going to be the tool that managed a projects dependency by pinning versoins of installed software and could over time manage the dependencies of dependencies.

^ One of the problems we as Magento developers faced was that Magento 1 shipped with a non standard or easily extensible autoloader so any opportunity to load or use these packages was not going to be an easy journey.

---
# [fit] Magento - Composer ![inline](https://getcomposer.org/img/logo-composer-transparent3.png)

![](images/hackathon-composer.png)

^ One of the problems we as Magento developers faced was that Magento 1 shipped with a non standard or easily extensible autoloader so any opportunity to load or use these packages was not going to be an easy journey.

^ Thankfully this bridge was crossed with the hard work of the many developers behind the magento composer hackathon project. Simple in design this project added as a plugin to composer can detect in a composer.json file a new node for module type and treat these modules deifferently to regular composer packages. The different being that it will based on deployment strategy move the files into the correct location. This can be based on json mappings of source to destination or reading modman files. 

---

# [fit] packages.firegento ![inline](https://getcomposer.org/img/logo-composer-transparent3.png)

![](images/firegento.png)

^ So now we had a means of installing Magento modules other than Connect or Modman but other than using connect to search or github search to find a package we were limited in how we could find this units of work. What we needed was our own packagist that we could search and find the packages that we wanted to install quickly and in a versioned way. What packages does is gives us the ability to install any of the Magento connect free modules, as well as allong any developer to publish there own modules via a simple pull request to the repository that powers this site. For the first time with this and all of the previous tools we were well on track to being able to share, pin versions and use other modules as a dependency on our own project. 

---

# [fit] Versioning
# 1.0.2
![](images/SemVerEvolution_3.png)

^ We may think that version numbers are just there for convinience increase the last digit each time you save the file. But versioning is an extremly powerfull communication tool. If we follow the semantic versioning spectification we can tell people alot about out modules stability. What we are trying to comunicate is what version is our module at. We should follow that the first digit represent any majour releases of this software. Big breaking changes Magento 2 could be 2.0.0 when it first started development. Its a massive change and not one that you can just upgrade to without cause for concern. Now the next digit is minour number this should be incremepnted when you add functionality in a backwards compatiable manour. Your adding new functionality but not breaking any of the old stuff. Finally the last digit is the patch version. Find a bug fix the bug push the patch number up. That way people can see how your module is progressing, AND they can pin via composer there version to only even update to patched versioned or minor versions. Tha is unless we just throw a * in our composer.json dependency.

---


![original](images/AS-pink-bg.png)

# [fit] Composable
# Magento

^ So how can we achieve this within Magento ? Well the Magento 2 core team have put alot of thought into how reuse can occur inside of Magento 2. There have been lots of improvments in Magento 2 that make reuse possible. You will hear Composer, Service Contracts, Dependency Injection used with any Magento 2 developer now. Because the world of software engineering has evolved since the days of initial Magento 1 we are priviliaged to be able to take advantage of this in our Magento 2 development. If you look in the core of Magento 2 modules you will see that each one its now its own true module that can be reused. It has a composer.json file listing what each modules dependency is ( granted some of the modules have a dependency on every other module ) but its starting to become more decoupled so in theory we can create a magento 2 installation selecting onlt the composer packages that we want to run the store. Exclude gift messaging for example simple we just dont put this into our composer file. 

---


# [fit] Service contracts

![original](images/AS-blue-bg.png)

^ In Magento 2 the core developers have introduced a notion of Service Contracts. In reality these are Interfaces that all modules should: Create so that they are providing a public API of how there module works, As well as using these service contracts within there code. Why does this matter ? Well there are many reasons. Some of the most important are its making module developers think more about how the modules are used. These public API's are not API's that are consumed by a client but are how developers can extend or interact with the module they are providing a gatewaw into the internals but its a contract to say that these will never change. If I have a contract for getName it will only ever return getName and what is good is that as a consume of this module I know that there is a single place to look for these API's. What this also means is that because we are working based on these service contracts we are limiting the number of backwards compatiability breaks that could occur. The module developers are free to change the internals of there modules how it collects data processes it etc. But the Service Contract will remain the same. Only in majour version releases should we ever be introducing BC breaks. 

---

# [fit] Dependency Injection

![original](images/injection.jpg)

^ At its core Magento 2 supports dependency injection. What dependency injection does in its most basic form is takes the creation of objects away from the class that is using then. This means we can really start to think about re use a lot more. In conjunction with service contracts / interfaces we are able to swap out the concrete implementations at run time so we are de coupling our actual implementation of the framework from our modules. DI in Magento 2 is a vast section to cover but what I will say is that it is investing the time in looking at how dependency injection throey is created and how Magento 2 implement it. When used correctly it means that we have modules that are self contained Plain ol PHP objects that we can inject back into the framework to persist or perform framework specific actions keeping our bespoke domain code outside of the framework and only injecting it in as a bridge into Magento 2.

---

# [fit] Abstraction
# away from the framework

![original](images/AS-black-bg.png)

^ If you are using composer and the generated autoloading functionality it is practical to write code that is unaware of Magento, that sits in some other location than a Magento module but is wired into the structures and deep inheritance chain that Magento defines. The wiring however is minimal and isolated away from the code that solve the actual problem. This means you have created a solution prime for re-use because it can be re-wired or re-composed into other projects and applications.

---

# [fit] The naked
# Magento module

![](images/emet.jpg)

^ The idea of the naked module is to create code that is completely unaware that it will be applied within a Magento application. This would mean that it can also be applied to a new version of Magento with a greatly reduced amount of re-work. We get to apply DRY in the true form and only create the new wiring to Magento 2 or 3 or 4. Magento will last for ever you know!

---

![original](images/AS-black-bg.png)

> Your **value** as an engineer is not the sum of the code you have written
-- LoC !== $$

^ The value of engineer is their ability to write code to solve problems. However their value is not attached to that code. Deleting code should not be painful and you should not be protective of your code beyond it's ability to solve a problem.

^ A higher value of an engineer is the ability to solve problems using the most appropriate solution available to them which may indeed involve choosing to not write code but instead assess and select an appropriate solution written by someone else.

---

![original](images/AS-black-bg.png)

# [fit] Ephemeralisation

---

![105%](http://blog.lucid.berlin/wp-content/uploads/sites/4/2015/02/r-buckminster-fuller-5.jpg)

#
# [fit] Doing more with less[^Fuller, 1938]

[^Fuller, 1938]: Buckminster (Bucky) Fuller

^ The true power of an engineer is doing more with less. Using composable components to deliver functionality should be seen as far superior to re-crafting code to solve a problem already solved by someone else. Not least because they may well know more about the problem than you. If the solution is fit for purpose then of course you should look to alternatives but first check that you are not being vein.

---

![original](images/AS-black-bg.png)

## Reuse through reduced MASS

## $$ mass = \frac{n}{m/s^2} $$

^ So what I'm proposing here is not simply a call to achieving more with less effort. It is about being more effective and achieving more reuse by building with less mass. DEMASS! Building code with a clean, clear intent that is focused on doing one thing well and only one thing.

---

# [fit] Building **LESS**, well!

![original](images/AS-black-bg.png)

^ Smaller more focused modules and components are more portable and more reusable. This should be a familiar principle. It is the principle upon which unix systems are based and other languages and platforms have got this right also e.g. node.js, python.

^ Building on the physics anecdote then objects with less mass have less inertia and it is much easier to influence their path. Making them much more flexible and usable in unplanned contexts.

---

# [fit] Thank you...

![original](images/AS-pink-bg.png)

---

![original](images/M2_BG-Cover-P.png)

---

![fill](https://www.youtube.com/watch?v=X8lqnO7aYe0&t=18s)

---

![original](images/AS-blue-bg.png)

# [We are hiring...]

---

# Credits

![original](images/AS-blue-bg.png)

* https://skillsmatter.com/skillscasts/6433-business-logic-a-different-perspective
* https://www.youtube.com/watch?v=X8lqnO7aYe0