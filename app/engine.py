import os
import json
import urllib

import h5py
import numpy as np
import pickle as pk

from tensorflow.keras.applications.vgg16 import VGG16
from tensorflow.keras.applications.imagenet_utils import preprocess_input, decode_predictions
from tensorflow.keras.preprocessing.image import ImageDataGenerator, array_to_img, img_to_array, load_img
from tensorflow.keras.models import Sequential, load_model
from tensorflow.keras.utils import get_file

# Load models and support
second_gate = load_model('static/models/ft_model_1.h5')


def prepare_img_256(img_path):
	img = load_img(img_path, target_size=(256, 256)) # this is a PIL image 
	x = img_to_array(img) # this is a Numpy array with shape (3, 256, 256)
	x = x.reshape((1,) + x.shape)/255
	return x

def car_damage_gate(img_256, model):
	pred = model.predict(img_256)
	if pred[0][0] <=.5:
		return True # print "Validation complete - proceed to location and severity determination"
	else:
		return False
		# print "Are you sure that your car is damaged? Please submit another picture of the damage."
		# print "Hint: Try zooming in/out, using a different angle or different lighting"


# load models
def engine(img_path):
	result = {}
	for i in range(len(img_path)):
		img_256 = prepare_img_256(img_path[i])
		ret = car_damage_gate(img_256, second_gate)
		if ret == True:
			result[i] = 1
		else:
			result[i] = 0

	return result