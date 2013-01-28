# Groupdocs Signature
============================

GroupDocs Signature plugin for ezPublish

With GroupDocs signature plugin for ezPublish you can easily [sign documents online](http://groupdocs.com/apps/signature), Word documents, Excel documents, Powerpoint documents and more with the GroupDocs signature tool, directly from within your ezPublish website.

###Plugin Manual Installation Instructions:
1. "groupdocssignature" module contain "design, modules, setting", so unzip it into "extentions" directory, so parent directory is "groupdocssignature"
2. Open file: "site/settings/override/site.ini.append.php" and add "ActiveExtensions[]=groupdocssignature" under "[ExtensionSettings]"
3. Go to Admin > Setup > Extentions and checkbox where "groupdocssignature" must be ticked
4. Then go to - Setup > Extentions and press "Regenerate autoloaded arrays for extentions" in the bottom
5. Grant permissions in admin go to - User Accounts > Roles and policies > Anonymous => Edit Role and if "groupdocssignature" isn't available in the list press - New Policy > choose Module: groupdocssignature > Grant access to all functions > Save
6. Go to Setup and press "Clear all caches"


###[Sign, Manage, Annotate, Assemble, Compare and Convert Documents with GroupDocs](http://groupdocs.com)
* [Sign documents online](http://groupdocs.com/apps/signature)
* [Download signature plugin package here](https://github.com/groupdocs/ez-groupdocs-signature)
* [See source code for GroupDocs signature plugin for ezPublish CMS](https://github.com/groupdocs/ez-groupdocs-signature-source)

###Created by [GroupDocs Marketplace Team](http://groupdocs.com/marketplace/).

###ChangeLog
2012-11-30
1.  Client CMS name tracking was added(referer parameter in the URL).