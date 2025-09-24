import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class Municipios {

    public static class Municipio {
        public String territorio;
        public String codigo;
        public double valor;

        public Municipio(String territorio, String codigo, double valor) {
            this.territorio = territorio;
            this.codigo = codigo;
            this.valor = valor;
        }
        @Override
        public String toString() {
            return "Territorio: " + territorio + ", Código: " + codigo + ", Valor: " + valor;
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
                String[] values = linea.split(delimitador);

                if (values.length < 6)
                    continue;
                if (!values[1].equalsIgnoreCase("Municipios"))
                    continue;
                if (values[4].equals("-"))
                    continue;

                double valor;
                try {
                    valor = Double.parseDouble(values[4]);
                } catch (NumberFormatException e) {
                    continue;
                }
                listaMunicipios.add(new Municipio(values[3], values[2], valor));
            }

            listaMunicipios.sort((m1, m2) -> Double.compare(m2.valor, m1.valor));

            System.out.println("Los 3 municipios con más mediana:");
            for (int i = 0; i < 3 && i < listaMunicipios.size(); i++) {
                System.out.println((i + 1) + ". " + listaMunicipios.get(i));
            }

        } catch (IOException e) {
            System.err.println("Error: " + e.getMessage());
        }
    }
}
