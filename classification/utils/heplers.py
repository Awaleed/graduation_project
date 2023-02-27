# import the necessary packages
import numpy as np
import os
import PIL
import os.path

def test_model(model, labels, data):
    prediction = []
    original = []
    image = []

    for i in os.listdir(os.path.join(data, 'evaluation')):
        if i == '.DS_Store': continue
        for item in os.listdir(os.path.join(data, 'evaluation', i)):
            if item == '.DS_Store': continue
            # code to open the image
            img = PIL.Image.open(os.path.join(data, 'evaluation', i, item))
            # resizing the image to (256,256)
            img = img.resize((256, 256))
            # appending image to the image list
            image.append(img)
            # converting image to array
            img = np.asarray(img, dtype=np.float32)
            # normalizing the image
            img = img / 255
            # reshaping the image in to a 4D array
            img = img.reshape(-1, 256, 256, 3)
            # making prediction of the model
            predict = model.predict(img)
            # getting the index corresponding to the highest value in the prediction
            predict = np.argmax(predict)
            # appending the predicted class to the list
            prediction.append(labels[predict])
            # appending original class to the list
            original.append(i)
    return prediction, original, image
