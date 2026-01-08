# Importaciones
import tensorflow as tf
import tensorflow_datasets as tfds # Para cargar el dataset MNIST
import matplotlib.pyplot as plt    # Para visualizar imágenes y gráficos
import numpy as np
import math
import logging

# Configuración básica (ocultar mensajes de error de TFDS)
logger = tf.get_logger()
logger.setLevel(logging.ERROR)

print("TensorFlow versión:", tf.__version__)

print("Cargando el dataset MNIST...")

# as_supervised=True: Separa automáticamente las imágenes (características) y las etiquetas (clases).
# with_info=True: Devuelve metadatos importantes sobre el dataset.
dataset, metadata = tfds.load('mnist', as_supervised=True, with_info=True)

# Separamos el dataset en conjuntos de entrenamiento y prueba
train_dataset, test_dataset = dataset['train'], dataset['test']

# Definimos los nombres de las clases (las 10 salidas posibles)
class_names = [
    'Cero', 'Uno', 'Dos', 'Tres', 'Cuatro', 'Cinco', 'Seis',
    'Siete', 'Ocho', 'Nueve'
]

# Obtenemos el número de ejemplos (para cálculos posteriores)
num_train_examples = metadata.splits['train'].num_examples
num_test_examples = metadata.splits['test'].num_examples

print(f"Total de ejemplos de entrenamiento: {num_train_examples}")
print(f"Total de ejemplos de prueba: {num_test_examples}")

# Función para normalizar los datos
def normalize(images, labels):
    # Convertimos los datos a float32 (números decimales)
    images = tf.cast(images, tf.float32)
    # Dividimos por 255.0 para normalizar (0-255 -> 0.0-1.0)
    images /= 255.0
    return images, labels

# Aplicamos la función 'normalize' a ambos datasets
train_dataset = train_dataset.map(normalize)
test_dataset = test_dataset.map(normalize)

# Tomamos una muestra para visualizar.
for image, label in train_dataset.take(1):
    break
image = image.numpy()

plt.figure(figsize=(2,2))
# El [...,0] es para seleccionar el único canal de color (escala de grises)
plt.imshow(image[...,0], cmap=plt.cm.binary)
plt.title(f"Ejemplo Normalizado: Etiqueta Real {class_names[label.numpy()]}")
plt.colorbar()
plt.show()
#

print("\nDefiniendo la estructura de la Red Neuronal (Keras Sequential)...")

model = tf.keras.Sequential([
	# 1. Capa de Aplanamiento (Flatten):
	# Convierte la matriz de entrada (28x28) en un vector plano (784).
	# Es el primer paso para alimentar las capas Dense.
  tf.keras.Input(shape=(28, 28, 1)),
	tf.keras.layers.Flatten(),

	# 2. Capa Oculta (Dense):
	# Tiene 64 neuronas.
	# Activación ReLU: Introduce no-linealidad, permitiendo aprender relaciones complejas.
	tf.keras.layers.Dense(64, activation=tf.nn.relu),

	# 3. Segunda Capa Oculta (Dense):
	tf.keras.layers.Dense(64, activation=tf.nn.relu),

	# 4. Capa de Salida (Dense):
	# 10 neuronas (una para cada clase 0-9).
	# Activación Softmax: Convierte las salidas en PROBABILIDADES que suman 1.
	# La neurona con mayor probabilidad será la predicción final.
	tf.keras.layers.Dense(10, activation=tf.nn.softmax)
])

# Compilación: Indicamos cómo debe aprender el modelo.
model.compile(
	# Optimizador: 'adam' es un algoritmo muy eficiente para ajustar los pesos del modelo.
	optimizer='adam',

	# Función de Pérdida (Loss Function):
	# Mide "qué tan mal" están las predicciones. El objetivo del entrenamiento es MINIMIZAR este valor.
	# 'sparse_categorical_crossentropy' se usa para clasificación multiclase con etiquetas enteras.
	loss='sparse_categorical_crossentropy',

	# Métrica: Lo que queremos MAXIMIZAR, en este caso, la precisión.
	metrics=['accuracy']
)

# BATCHSIZE: El tamaño del lote de imágenes que el modelo procesa a la vez.
BATCHSIZE = 32

# .repeat(): Permite iterar sobre el dataset múltiples veces (para las 5 épocas).
# .shuffle(): Mezcla los datos al inicio de cada repetición.
# .batch(BATCHSIZE): Agrupa los datos.
train_dataset = train_dataset.repeat().shuffle(num_train_examples).batch(BATCHSIZE)
test_dataset = test_dataset.batch(BATCHSIZE)

# Número de pasos que hay que dar para recorrer todos los ejemplos en cada época
steps_per_epoch = math.ceil(num_train_examples / BATCHSIZE)

print("\nComenzando el entrenamiento del modelo (5 épocas)...")
# epochs=5: El modelo verá todo el set de entrenamiento 5 veces.
history = model.fit(
	train_dataset,
	epochs=5,
	steps_per_epoch=steps_per_epoch # El número de lotes por época.
)
print("\n¡Entrenamiento completado!")

# Opcional: Visualizar la pérdida y la precisión
plt.figure(figsize=(12, 4))
plt.subplot(1, 2, 1)
plt.plot(history.history['accuracy'], label='Precisión')
plt.title('Precisión (Accuracy) durante el Entrenamiento')
plt.xlabel('Época')
plt.ylabel('Precisión')
plt.legend()
plt.show()

print("\nEvaluando el modelo contra el dataset de prueba...")
test_loss, test_accuracy = model.evaluate(
	test_dataset, steps=math.ceil(num_test_examples/BATCHSIZE)
)

print("\n--- Resultado Final ---")
print(f"Precisión (Accuracy) en las pruebas: {test_accuracy*100:.2f}%")
print("-----------------------")

# Tomamos un lote de imágenes para probar y visualizar
for test_images, test_labels in test_dataset.take(1):
	test_images = test_images.numpy()
	test_labels = test_labels.numpy()
	predictions = model.predict(test_images)

# Función para mostrar la imagen y la predicción del modelo
def plot_image(i, predictions_array, true_labels, images):
	predictions_array, true_label, img = predictions_array[i], true_labels[i], images[i]
	plt.grid(False)
	plt.xticks([])
	plt.yticks([])
	plt.imshow(img[...,0], cmap=plt.cm.binary)

	predicted_label = np.argmax(predictions_array)

	# Azul = Correcto. Rojo = Incorrecto.
	if predicted_label == true_label:
		color = 'blue'
	else:
		color = 'red'

	plt.xlabel(f"Predicción: {class_names[predicted_label]} ({100*np.max(predictions_array):.2f}%)", color=color)

# Función para mostrar el gráfico de barras de probabilidades
def plot_value_array(i, predictions_array, true_label):
	predictions_array, true_label = predictions_array[i], true_label[i]
	plt.grid(False)
	plt.xticks(range(10), class_names, rotation=45) # Rotamos para que quepan
	plt.yticks([])
	thisplot = plt.bar(range(10), predictions_array, color="#888888")
	plt.ylim([0,1])
	predicted_label = np.argmax(predictions_array)

	# El color AZUL indica la etiqueta REAL (correcta).
	# El color ROJO indica la predicción del modelo.
	thisplot[predicted_label].set_color('red')
	thisplot[true_label].set_color('blue')

numrows=5
numcols=3
numimages = numrows*numcols

plt.figure(figsize=(2*2*numcols, 2*numrows))
for i in range(numimages):
	# Columna 1: La imagen y la predicción
	plt.subplot(numrows, 2*numcols, 2*i+1)
	plot_image(i, predictions, test_labels, test_images)

	# Columna 2: El gráfico de barras de probabilidades
	plt.subplot(numrows, 2*numcols, 2*i+2)
	plot_value_array(i, predictions, test_labels)

plt.tight_layout()
plt.show()