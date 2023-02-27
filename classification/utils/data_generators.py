import pandas as pd
import os
from keras.preprocessing.image import ImageDataGenerator
import os.path
from .globals import input_path

data = input_path


# create run-time augmentation on training and test dataset
# For training datagenerator,  we add normalization, shear angle, zooming range and horizontal flip
train_datagen = ImageDataGenerator(
    rescale=1./255,
    shear_range=0.2,
    zoom_range=0.2,
    horizontal_flip=True
)

# For test datagenerator, we only normalize the data.
test_datagen = ImageDataGenerator(rescale=1./255)


train_generator = train_datagen.flow_from_directory(
    os.path.join(data, 'training'),
    target_size=(256, 256),
    batch_size=32,
    class_mode='categorical'
)

validation_generator = test_datagen.flow_from_directory(
    os.path.join(data, 'validation'),
    target_size=(256, 256),
    batch_size=32,
    class_mode='categorical',
)

test_generator = test_datagen.flow_from_directory(
    os.path.join(data, 'evaluation'),
    target_size=(256, 256),
    batch_size=32,
    class_mode='categorical'
)
