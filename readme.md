# Portfolio Project

## Models
- **FAQ Model**
    - This model is unpopulated to date.
    - It's purpose will be to handle CRUD ops for FAQs
- **User Model**
    - This model is pretty much bone stock, meaning there are no special considerations implemented such as Eloquent relations to any other models.

## Views
**Clayton's Recommendation-** These views could be better organized to support a front-end. For example, we could use a master layout file with partials to inject needed CSS, META, JS. Doing this allows easier navigation through the code base. Also if for example we were to implement a dashboard for the photographer we could sort of separate concerns. Additionally, not every view is going to need certain CSS rules, or JS functions. Using Blade properly allows us to inject items on an AS-NEEDED basis. But this also begs the question, is it worth it to serve a separate front-end within the public directory of this app (on this server).

- **AUTH**
  - **_login**
  - **_password**
  - **_register**
  - **_reset**
- **EMAIL**
  - **_contact**
  - **_contactReply**
  - **_customerBill**
  - **_groupOrder**
  - **_order**
  - **_password**
  - **_paymentNotification**
  - **_paymentThanks**
  - **_serviceRequest**
- **ERRORS**
  - **503**
- **PARTIALS**
  - **_nav**
- **SUPERFULOUS VIEWS** 

## Controllers

- **ClientGalleryUploadController**
    - Handles upload of client image files
    
    
    
## Needed Work
- [ ] **Storyboarding**
    - [ ] **What should we see upon fresh install?** Setup wizard.

- [ ] **Separation of concerns within controllers**

Each controller should implement it's own concerns. For example, the FaqController should handle methods related to it's class. In the event that not every method should require Auth see below.

Assigning Auth Middleware within the controller:

```php
public function __construct()
{

   // This will force Auth on all methods within the 
   // controller
   $this->middleware('auth');
   
   // This will force Auth on all methods except the
   // index method
   $this->middleware('auth', ['except'=>'index']);
   
   // This will force Auth only on specified methods
   $this->middle('auth'=>['only'=>'edit']);
   
   // This will force Auth only to what is declared 
   // in an array of mehtods
   $this->middleware('auth'=>['only'=>[
     'edit',
     'destroy'
     'update'
    ]]);
   
}
```
   
- [ ] **Create First time use Setup Wizard**
   
- [ ] **Create Blogging Feature**
   
- [ ] **My Branding**
