<?php

require_once 'arc/ARC2.php';

class EasyRdf_ArcParser
{
    private static $supported_types = array(
        'application/json' => 'JSON',
        'application/rdf+xml' => 'RDFXML',
        'text/turtle' => 'Turtle',
    );

    public function parse($uri, $data, $doc_type='')
    {
        if (array_key_exists( $doc_type, self::$supported_types )) {
            $class_name = self::$supported_types[$doc_type];
        } else {
            # FIXME: throw exception?
            return null;
        }
        
        $parser = ARC2::getParser( $class_name );
        if ($parser) {
            $parser->parse($uri, $data);
            return $parser->getSimpleIndex(false);
        } else {
            # FIXME: throw exception?
            return null;
        }
    }
}
