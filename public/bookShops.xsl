<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="shops">
        <xsl:for-each select="shop">
            <section>
                <h3>
                    <xsl:value-of select="name"/>
                </h3>
                <p>
                    <span class="bold">Address: </span>
                    <span><xsl:value-of select = "address"/> </span>
                </p>

                <p>
                    <span class="bold">Description: </span>
                    <span><xsl:value-of select="description"/></span>
                </p>

                <p>
                    <span class="bold">Phone: </span>
                    <span><xsl:value-of select="phone"/></span>
                </p>

                <p>
                    <span class="bold">More info: </span>
                    <a>
                        <xsl:attribute name="href">
                            <xsl:value-of select="url"/>
                        </xsl:attribute>
                        <xsl:value-of select="url"/>
                    </a>
                </p>

                <p>
                    <span class="bold">
                        Coordinates:
                    </span>
                    <button>
                        <xsl:attribute name="data-lon">
                            <xsl:value-of select="coordinates/longitude"/>
                        </xsl:attribute>
                        <xsl:attribute name="data-lat">
                            <xsl:value-of select="coordinates/latitude"/>
                        </xsl:attribute>
                        <xsl:attribute name="onfocus">#map</xsl:attribute>
                        <xsl:attribute name="onclick">showOnMap(this.getAttribute('data-lat'), this.getAttribute('data-lon'))</xsl:attribute>
                        <a href="#out">
                        Locate
                        </a>
                    </button>
                </p>
                <ul>
                    <li>
                        <span><xsl:value-of select="coordinates/longitude"/></span>
                    </li>
                    <li>
                        <span><xsl:value-of select="coordinates/latitude"/></span>
                    </li>
                </ul>
                <p>
                    <span class="bold">Pictures: </span>
                </p>

                <xsl:for-each select="pictures/picture">
                    <img>
                        <xsl:attribute name="src">
                             <xsl:value-of select="@source"/>
                              </xsl:attribute>
                              <xsl:attribute name="alt">
                                   <xsl:value-of select="."/>
                              </xsl:attribute>
                     </img>
                 <br />
                </xsl:for-each>
            </section>
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>
