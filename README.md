# PHP Web Services
A simple web services project written in PHP.

For each entity, there is three parts:
 - Model
 - DAO
 - Service

## Model
Objects which are returned by the services. It mostly matches with database tables.

## DAO
Data Access Object, it includes methods to access data and serve objects from the model.

## Service
One service by url extension, like /user, it serves data called from DAO methods based on http method.

## URL
The url system is basically composed by ip or dns name, followed by service name, then by an id if needed.