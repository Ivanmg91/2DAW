import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class Municipios {

    // Make Municipio static
    public static class Municipio {
        public String ano;
        public String tipo;
        public String codigoMunicipio;
        public String territorio;
        public String valor;
        public String estadoDato;

        @Override
        public String toString() {
            return "Año:'" + ano + "Tipo:'" + tipo +"Código Municipio:'" + codigoMunicipio + "Territorio:'" + territorio +"Valor:'" + valor +"EstadoDato:'" + estadoDato + "";
        }
    }

    public static void main(String[] args) {
        String pathcsv = "viviendas-por-intensidad-de-uso-a-partir-del-consumo-electrico.-mediana-consumo-anual.csv";
        String linea;
        String delimitador = ";";

        List<Municipio> listaMunicipios = new ArrayList<>();

        try (BufferedReader br = new BufferedReader(new FileReader(pathcsv))) {

            br.readLine();

            while ((linea = br.readLine()) != null) {
                Municipio municipio = new Municipio();
                String[] values = linea.split(delimitador);
                // System.out.println(values[3] + ", " + values[4] + ", " + values[2]);

                municipio.ano = values[0];
                municipio.tipo = values[1];
                municipio.codigoMunicipio = values[2];
                municipio.territorio = values[3];
                municipio.valor = values[4];
                municipio.estadoDato = values[5];

                listaMunicipios.add(municipio);
            }

            System.out.println(listaMunicipios);

        } catch (IOException e) {
            System.err.println(e.getMessage());
        }
    }
}
