<?php
/**
 * LC Schema Markup
 *
 * Copied from the original lc-iology theme to preserve LocalBusiness + opening hours schema.
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output schema markup for the site.
 *
 * @return void
 */
function lc_output_schema() {
    if ( is_front_page() || is_home() ) {

        // ORGANIZATION SCHEMA.
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'Optician',
            '@id'         => 'https://iology.co.uk/#business',
            'name'        => 'Iology',
            'url'         => 'https://iology.co.uk/',
            'image'       => 'https://iology.co.uk/wp-content/uploads/2023/02/iology-org.png',
            'logo'        => 'https://iology.co.uk/wp-content/uploads/2023/02/iology-org.png',
            'description' => 'Independent optician in Barking offering comprehensive eye tests, contact lenses, glasses, and family eye care.',
            'slogan'      => 'Your local, independent optician.',
            'telephone'   => '020 8594 2714',
            'address'     => array(
                '@type'           => 'PostalAddress',
                'streetAddress'   => '50 Ripple Road',
                'addressLocality' => 'Barking',
                'postalCode'      => 'IG11 7PG',
                'addressCountry'  => 'GB',
            ),
            'geo'         => array(
                '@type'     => 'GeoCoordinates',
                'latitude'  => 51.5364754,
                'longitude' => 0.0811518,
            ),
            'sameAs'      => array(
                'https://www.instagram.com/iology1',
                'https://www.google.com/maps/place/?q=place_id:ChIJIaUhT22m2EcRauJmDuJeaqs',
            ),
        );

        // Add opening hours from plugin if available.
        if ( function_exists( 'get_opening_hours_specification_array' ) ) {
            $opening_hours = get_opening_hours_specification_array();
            if ( ! empty( $opening_hours ) ) {
                $schema['openingHoursSpecification'] = $opening_hours;
            }
        }
        echo '<script type="application/ld+json">';
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
        echo '</script>';

        $aggregate_rating = array(
            '@context'     => 'https://schema.org',
            '@type'        => 'AggregateRating',
            'itemReviewed' => array(
                '@id' => 'https://iology.co.uk/#business',
            ),
            'ratingValue'  => get_field( 'ratingvalue', 'options' ),
            'reviewCount'  => get_field( 'reviewcount', 'options' ),
            'bestRating'   => get_field( 'bestrating', 'options' ),
            'worstRating'  => get_field( 'worstrating', 'options' ),
        );
        echo '<script type="application/ld+json">';
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo wp_json_encode( $aggregate_rating, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
        echo '</script>';
    }

    if ( is_page( 'contact' ) ) {
        $contact_schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'ContactPage',
            'name'     => 'Contact Iology',
            'url'      => get_permalink(),
            'about'    => array(
                '@id' => 'https://iology.co.uk/#business',
            ),
        );
        echo '<script type="application/ld+json">';
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo wp_json_encode( $contact_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
        echo '</script>';
    }
}
