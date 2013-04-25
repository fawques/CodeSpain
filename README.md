<h1>CodeSpain</h1>
CodeSpain es una aplicación web que permite a los desarrolladores encontrar fácilmente eventos de desarrollo en España.
Visita nuestro [Roadmap](docs/ROADMAP.md) y si te interesa lo que ves, siempre puedes ayudarnos o darnos feedback! :D

<h2>Árbol de directorios</h2>
El árbol de directorios del proyecto puede ser algo complejo, ya que depende en buena parte del código de [Yii Framework](http://www.yiiframework.com/). Esta es la estructura de directorios y su función:

<table cellspacing="0" cellpadding="0" >
    <tbody>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/BD">BD</a></td>
            <td >Esquemas para generar la Base de Datos</td>
        </tr>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/assets">assets</a></td>
            <td >Librerías y recursos externos</td>
        </tr>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/css">css</a></td>
            <td >Retoques de css</td>
        </tr>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/docs">docs</a></td>
            <td >Documentación</td>
        </tr>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/framework">framework</a></td>
            <td >Código del framework. Incluido para facilitar la instalación</td>
        </tr>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/images">images</a></td>
            <td >Imágenes usadas en la aplicación</td>
        </tr>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/js">js</a></td>
            <td >Código JavaScript para la aplicación</td>
        </tr>
        <tr>
            <td ><a href="/fawques/CodeSpain/tree/master/protected">protected</a></td>
            <td >Carpeta principal del proyecto. Esta carpeta no debe ser pública una vez subida al servidor.</td>
        </tr>
        <tr>
            <td >
                <table cellspacing="0" cellpadding="0" >
                    <tbody data-url="/fawques/CodeSpain/tree-commits/master/protected" >
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/components">components</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/config">config</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/controllers">controllers</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/data">data</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/extensions">extensions</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/models">models</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/runtime">runtime</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/tests">tests</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/vendors">vendors</a></td>
                        </tr>
                        <tr>
                            <td ><a href="/fawques/CodeSpain/tree/master/protected/views">views</a></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td >
                <table cellspacing="0" cellpadding="0" >
                    <tr>
                        <td >Contiene componentes (como widgets o utilidades)</td>
                    </tr>
                    <tr>
                        <td >Contiene los archivos de configuración principales</td>
                    </tr>
                    <tr>
                        <td >Contiene los controladores de la aplicación</td>
                    </tr>
                    <tr>
                        <td >Contiene la base de datos usada por el proyecto</td>
                    </tr>
                    <tr>
                        <td >Contiene extensiones externas incluidas en el proyecto. Cada una de ellas funciona para Yii como una aplicación separada.</td>
                    </tr>
                    <tr>
                        <td >Contiene los modelos de datos de la aplicaci</td>
                    </tr>
                    <tr>
                        <td >Se utiliza en tiempo de ejecución en el servidor</td>
                    </tr>
                    <tr>
                        <td >Contiene los tests</td>
                    </tr>
                    <tr>
                        <td >Contiene plugins externos</td>
                    </tr>
                    <tr>
                        <td >Contiene las vistas de la aplicación</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            
            <td ><a href="/fawques/CodeSpain/tree/master/themes">themes</a></td>
            <td >Carpeta de personalización de temas. Necesaria para incluir Yii-Boostrap</td>
        </tr>
    </tbody>
</table>


Dependencias
------------------
Lo único que se necesita para poder ejecutar CodeSpain es un servidor web con soporte para PHP y MySQL. ¡Nada más!

<h2>INSTALACION</h2>
Primeramente hay que instalar un sevidor web con php y una base de datos mysql, según la plataforma que elijas te dejamos un link para cada una de ellas:
- Linux: [Link](http://codespain.es/blog/software-a-instalar/ "Link hacia cómo instalar en linux")
- Windows: [Link] (http://ajbalmon.wordpress.com/2008/06/25/instalando-xampp-en-windows "Link hacia cómo instalar en Windows")
- Mac: [Link](http://lecheconsoja.blogspot.com.es/2011/03/como-instalar-xampp-en-mac-os-x.html "Link hacia cómo instalar en Mac")

Con esto instalado, ahora toca descargarse el proyecto y para más comodidad descargalo y extraelo directamente en la carpeta pública del servidor web que normalmente se llama htdocs (en caso de ubuntu se llama '/opt/lampp/htdocs/').

Descargado el proyecto y extraido aquí, te vas a un navegador y pones: "localhost/Nombre_Carpeta" (dónde esté el proyecto extraido, si es en raíz de htdocs, sin añadir nada). Y voila! Ya tienes nuestro proyecto en local.

Documentación
---------------------
La documentación del proyecto está, además de en [nuestro blog](http://www.codespain.es/blog), en la carpeta [docs](docs). Allí podrás encontrar la guía de usuario (en formato pdf) y el roadmap del desarrollo. También puedes ver nuestro tablero Kanban en [Trello](https://trello.com/board/codespain/5127cb5fd5c690da430057f3).

<h2>LICENCIA</h2>
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
    


