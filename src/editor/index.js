import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { useEntityProp } from '@wordpress/core-data';
import { TextControl } from '@wordpress/components';

function SocialLinksPanel() {
    const [ meta, setMeta ] = useEntityProp( 'postType', 'person', 'meta' );

    return (
        <>
            <PluginDocumentSettingPanel
                name="yp-general-info"
                title={ __( 'General Info', 'your-people' ) }
                className="yp-general-info"
                initialOpen={true}
            >
                <TextControl
                    label={ __(
                        'Title',
                        'your-people'
                    ) }
                    value={ meta?.yp_job_title || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_job_title: newValue,
                        } )
                    }
                    help={ __(
                        'The person\'s job title(s).',
                        'your-people'
                    ) }
                />
                <TextControl
                    label={ __(
                        'Professional Designation',
                        'your-people'
                    ) }
                    value={ meta?.yp_professional_designation || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_professional_designation: newValue,
                        } )
                    }                   
                    help={ __(
                        'The professional designation of the person (MD, RN, MBA, etc.)',
                        'your-people'
                    ) }
                />
                <TextControl
                    label={ __(
                        'Employer/Institution',
                        'your-people'
                    ) }
                    value={ meta?.yp_institution || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_institution: newValue,
                        } )
                    }
                />
                <TextControl
                    label={ __(
                        'Location',
                        'your-people'
                    ) }
                    value={ meta?.yp_location || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_location: newValue,
                        } )
                    }
                />
                <TextControl
                    label={ __(
                        'Email Address',
                        'your-people'
                    ) }
                    value={ meta?.yp_email_address || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_email_address: newValue,
                        } )
                    }
                />
                <TextControl
                    label={ __(
                        'Personal Website',
                        'your-people'
                    ) }
                    value={ meta?.yp_website_url || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_website_url: newValue,
                        } )
                    }
                />
            </PluginDocumentSettingPanel>
            <PluginDocumentSettingPanel
                name="yp-social-links"
                title={ __( 'Social Links', 'your-people' ) }
                className="yp-social-links"
                initialOpen={true}
            >
                <TextControl
                    label={ __(
                        'Facebook URL',
                        'your-people'
                    ) }
                    value={ meta?.yp_facebook || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_facebook: newValue,
                        } )
                    }
                />
                <TextControl
                    label={ __(
                        'LinkedIn URL',
                        'your-people'
                    ) }
                    value={ meta?.yp_linkedin_url || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_linkedin_url: newValue,
                        } )
                    }
                />
                <TextControl
                    label={ __(
                        'Instagram URL',
                        'your-people'
                    ) }
                    value={ meta?.yp_instagram_url || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_instagram_url: newValue,
                        } )
                    }
                />
                <TextControl
                    label={ __(
                        'X (Twitter) URL',
                        'your-people'
                    ) }
                    value={ meta?.yp_x_url || '' }
                    onChange={ ( newValue ) =>
                        setMeta( {
                            ...meta,
                            yp_x_url: newValue,
                        } )
                    }
                />
            </PluginDocumentSettingPanel>
        </>
    );
}

registerPlugin( 'yp-social-links-panel', { render: SocialLinksPanel } );