import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

public class Municipios {
    public static void main(String[] args) {
        String pathcsv = "viviendas-por-intensidad-de-uso-a-partir-del-consumo-electrico.-mediana-consumo-anual.csv";
        String linea;
        String delimitador = ";";

        try (BufferedReader br = new BufferedReader(new FileReader(pathcsv))) {
            while ((linea = br.readLine()) != null) {
                String[] values = linea.split(delimitador);
                System.out.println(values[3] + ", " + values[4] + ", " + values[2]);
                System.out.println();
            }
        } catch (IOException e) {
            System.err.println(e.getMessage());
        }
    }
}

/*
 * Hacer lista de listas y ordenar los municipos por el valor e imprimir las 3
 * primeras
 */