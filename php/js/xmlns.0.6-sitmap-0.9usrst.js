<xsd:schema targetNamespace="http://www.sitemaps.org/schemas/sitemap/0.9" elementFormDefault="qualified"><xsd:annotation><xsd:documentation>
    XML Schema for Sitemap index files.
    Last Modifed 2009-04-08
  </xsd:documentation></xsd:annotation><xsd:element name="sitemapindex"><xsd:annotation><xsd:documentation>
      Container for a set of up to 50,000 sitemap URLs.
      This is the root element of the XML file.
    </xsd:documentation></xsd:annotation><xsd:complexType><xsd:sequence><xsd:element name="sitemap" type="tSitemap" maxOccurs="unbounded"/></xsd:sequence></xsd:complexType></xsd:element><xsd:complexType name="tSitemap"><xsd:annotation><xsd:documentation>
      Container for the data needed to describe a sitemap.
    </xsd:documentation></xsd:annotation><xsd:all><xsd:element name="loc" type="tLocSitemap"/><xsd:element name="lastmod" type="tLastmodSitemap" minOccurs="0"/></xsd:all></xsd:complexType><xsd:simpleType name="tLocSitemap"><xsd:annotation><xsd:documentation>
      REQUIRED: The location URI of a sitemap.
      The URI must conform to RFC 2396 (http://www.ietf.org/rfc/rfc2396.txt).
    </xsd:documentation></xsd:annotation><xsd:restriction base="xsd:anyURI"><xsd:minLength value="12"/><xsd:maxLength value="2048"/></xsd:restriction></xsd:simpleType><xsd:simpleType name="tLastmodSitemap"><xsd:annotation><xsd:documentation>
      OPTIONAL: The date the document was last modified. The date must conform
      to the W3C DATETIME format (http://www.w3.org/TR/NOTE-datetime).
      Example: 2005-05-10
      Lastmod may also contain a timestamp.
      Example: 2005-05-10T17:33:30+08:00
    </xsd:documentation></xsd:annotation><xsd:union><xsd:simpleType><xsd:restriction base="xsd:date"/></xsd:simpleType><xsd:simpleType><xsd:restriction base="xsd:dateTime"/></xsd:simpleType></xsd:union></xsd:simpleType></xsd:schema>
