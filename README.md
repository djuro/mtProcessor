



# mtProcessor
The application is based on Symfony2 framework. It has one Rest endpoint accepting POST requests. The message received contains data about particular money transfer.

The application has been done as a task for CurrencyFair Company.

My work is in the following bundles: 

`/src/DM/AnalyticsBundle`,
`/src/DM/ConsumerBundle` and 
`/src/DM/PresentationBundle`.


Authenticated User have access to messages list, reports list and "New report" form. Report preview is based on it's result data type. It can be numeric or graphic.

User can create reports for available trends and preview result on reports list, or by clicking an icon to preview a graph report.

Available trends implementation is basic and just for example. It is easy scalable because it involves Strategy pattern solution.
