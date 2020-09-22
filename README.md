# Steps taken to change code

### Refactor the ExampleModel class to be pure OOP
#### convert array returned by mysql query into object using type casting and returned that object 
#### data recieved from request object is set to the model object in controller and used in ExampleModel create function directly


### Convert ExampleController::createExample()
#### Set the post request data onto the ExampleModel object using settter methods
#### Pass ExampleModel object onto the view


### Convert ExampleView::get() 
#### Take in the ExampleModel object as a parameter
#### Verify the ExampleModel object is initialized with data
#### Pass the ExampleModel object/data to the view

