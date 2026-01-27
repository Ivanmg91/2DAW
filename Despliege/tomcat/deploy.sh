#!/bin/bash

# Nombre del archivo Java
SERVLET="MiServlet.java"
CLASS="MiServlet.class"
HTML="parametros.html"

# Ruta destino en Tomcat
DESTINO="/var/lib/tomcat9/webapps/Proyecto1/WEB-INF/classes/"
DESTINOHTML="/var/lib/tomcat9/webapps/Proyecto1"

echo "---------------------------------------"
echo "  DEPLOY AUTOMÁTICO DE SERVLET"
echo "---------------------------------------"

# 1. Verificar que existe el archivo Java
if [ ! -f "$SERVLET" ]; then
    echo "❌ Error: No se encontró $SERVLET"
    exit 1
fi

# 2. Compilar
echo "🔧 Compilando $SERVLET..."
javac "$SERVLET"

if [ $? -ne 0 ]; then
    echo "❌ Error al compilar. Revisa el código."
    exit 1
fi

# 3. Mover el .class al directorio de Tomcat
echo "📦 Moviendo $CLASS a Tomcat..."
sudo cp "$CLASS" "$DESTINO"
sudo cp "$HTML" "$DESTINOHTML"

# 4. Reiniciar Tomcat
echo "🔄 Reiniciando Tomcat..."
sudo service tomcat9 restart

echo "✅ Deploy completado correctamente."
echo "---------------------------------------"

