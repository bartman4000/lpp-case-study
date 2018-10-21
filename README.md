# LPP Case Study Summary

1. I understood readme.txt description in a way that task should work in php >= 5.3 environment, therefore I stayed with PHP5 syntax 
2. As I needed Composer's dependencies anyway, I decided to skip of delivered SPLautoloader
3. Instead of creating just ItemValidator, I made common EntityValidator but defined constraint only for Item class. Seemed to me like more future-proof solution.
4. Made another implementation of BrandServiceInterface called OrderedBrandService which allows to have setted additional callables for sorting logic.
5. Found in BrandServiceInterface phpdoc excerpt:

```Second responsibility is to sort the returning result from the item service in whatever way.
  Please write in the case study's summary if you find this approach correct or not. In both cases explain why.
  ```
  
  I don't know if it was directed to me :-), however I would say it's not correct. It's against of SOLID principles (Single Responsibility among others).
  There should be separate class or callable object responsible of sorting, that can be however injected to BrandService Or ItemService (depending on which level we decide to make the sorting)
  
6. As ItemServiceInterface and BrandServiceInterface seem like core elements of this task, I didn't what to change them. 
However, keeping method only for test purpose (I mean ***BrandServiceInterface::setItemService***) is bad practice.

