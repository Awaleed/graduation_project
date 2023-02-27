import os

from fastapi import FastAPI, File, UploadFile

import PIL
import numpy as np
import tensorflow as tf
from keras.models import load_model

app = FastAPI()


labels = [
    'Necrotic-Tumor',
    'Non-Tumor',
    'Viable',
]

model = load_model('models/model1.h5')


@app.post('/uploadimage')
async def upload_image(file: UploadFile = File(...)):
    # create 'uploaded_images' folder if not exists
    if not os.path.exists("uploaded_images"):
        os.makedirs("uploaded_images")

    # save file to disk in folder 'uploaded_images'
    with open(f"uploaded_images/{file.filename}", "wb") as buffer:
        buffer.write(file.file.read())

    # loading images and their predictions
    img = PIL.Image.open(f"uploaded_images/{file.filename}")
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
        "filename": file.filename,
        "prediction": prediction,
    }

    for result in rawPredict:
        for i, r in enumerate(result):
            dect[labels[i]] = str(r)

    return dect
