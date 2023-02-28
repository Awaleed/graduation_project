from keras.models import load_model
import tensorflow as tf
import numpy as np
import PIL
import os

from flask import Flask, request


app = Flask(__name__)

labels = [
    'Necrotic-Tumor',
    'Non-Tumor',
    'Viable',
]

model = load_model('models/model1.h5')


@app.post('/uploadimage')
def upload_image():
    f = request.files['file']
    name = f"uploaded_images/{f.filename}"

    # create 'uploaded_images' folder if not exists
    if not os.path.exists("uploaded_images"):
        os.makedirs("uploaded_images")
    f.save(name)

    # loading images and their predictions
    img = PIL.Image.open(name)
    # resizing the image to (256,256)
    img = img.resize((256, 256))
    # converting image to array
    img = np.asarray(img, dtype=np.float32)
    # normalizing the image
    img = img / 255
    # reshaping the image in to a 4D array
    img = img.reshape(-1, 256, 256, 3)
    # making prediction of the model
    rawPredict = model.predict(img)
    # getting the index corresponding to the highest value in the prediction
    predict = np.argmax(rawPredict)
    # appending the predicted class to the list
    prediction = labels[predict]

    dect = {
        "prediction": prediction,
    }

    for result in rawPredict:
        for i, r in enumerate(result):
            dect[labels[i]] = str(r)

    return dect


if __name__ == '__main__':
    app.run(debug=True)
