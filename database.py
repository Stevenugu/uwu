import sqlite3
import os

def create_db():
    try:
        # Verificar si la BD ya existe
        db_exists = os.path.exists('formulario.db')
        
        conn = sqlite3.connect('formulario.db')
        cursor = conn.cursor()
        
        cursor.execute('''
            CREATE TABLE IF NOT EXISTS usuarios (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                correo TEXT NOT NULL
            )
        ''')
        
        conn.commit()
        print("✓ Base de datos creada/verificada correctamente")
        
    except sqlite3.Error as e:
        print(f"✗ Error en la base de datos: {e}")
    finally:
        if conn:
            conn.close()

# Solo ejecutar si se corre como script principal
if __name__ == "__main__":
    create_db()