Named Entity Recogniser

The system learns from the train and development data set as to whether a particular word is a Person Name or an Organisation name and so forth.When provided a test document it applies its learning on the words in the test file to determine what each word is.

Generate the features using the following run commands :

python HomeWork1.py eng.train.bio 
python HomeWork1.py eng.development.bio 
python HomeWork1.py eng.testing

