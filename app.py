from flask import Flask, render_template, request
import sqlite3

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/guardar', methods=['POST'])
def guardar():
    nombre = request.form['nombre']
    correo = request.form['correo']

    # guardar en la base de datos
    conn = sqlite3.connect('formulario.db')
    cursor = conn.cursor()
    cursor.execute("INSERT INTO usuarios (nombre, correo) VALUES (?, ?)", (nombre, correo))
    conn.commit()
    conn.close()  # ¡Esta línea estaba mal indentada!

    return "Datos guardados correctamente"

if __name__ == '__main__':
    app.run(debug=True)
