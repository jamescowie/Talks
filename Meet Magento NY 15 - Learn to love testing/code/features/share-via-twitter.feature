Feature: Share via twitter
   In order to share products I like with my followers
   As a visitor of the site
   I need to be able to quickly share the product via twitter

   Scenario: Admin can configure a product to be shared
      Given I am logged into the admin as "admin" with "password123"
      And I enabled social-share for "product-1"
      When I save the product
      Then I should see a success message 

   Scenario: Visitor can share a product via twitter
      Given "product-1" is enabled for social-share
      When I visit the product details page
      Then I should see that I can share the product via twitter

      
