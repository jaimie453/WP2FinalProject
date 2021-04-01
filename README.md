# WP2FinalProject

## Overview
You can work in groups of two for this assignment. It is also possible to work individually, but I do strongly discourage it; please talk to me about this if you are planning on working by yourself. This assignment will allow you to apply the concepts and technologies covered in class to a “real” project situation.  In this project, you will design and implement a web application for a fictional travel photo sharing community site. Some parts of the site will be available to the public; other parts in the site will eventually (see Part II) only be available to site administrators. By the end of the assignment you will have a non-trivial web application that can be a tremendous portfolio piece. 
If working in a group, each member needs to take responsibility for and complete an appropriate amount of the project work. Be sure to consult the instructor at least one week prior to the due date if your group is experiencing serious problems in this regard.

## Deliverables Summary
You must implement the use cases described in the use case section. As well, the following nonfunctional requirements must be met in this milestone:
1. The use cases must be implemented in PHP. You will be using a version of the Art database (similar to the one of your previous assignments). 
1. Be sure to make use of the appropriate features of PHP. Be sure to use good programming. Appropriate programming design patterns are encouraged if you completed CS III.

## Submitting
Submit under Learn:
1. ALL the url of the pages created by you. The links MUST be:
1. written in the text submission area and NOT in the comment area
1. written one per line with no other words preceding or following the link, and 
1. linked to the page (hyperlink). 
1. ALL the .php files you have created zipped in a folder named FinalProject_Group# (e.g., FinalProject_Group#1).
You will lose marks if you do not follow these submission instructions.
Submit Part I and Part II separately in the appropriate area by the due time.

## TimeLine and Submission Deadlines
In order to complete the project on time you must follow this timeline:
1. Part I must be completed by not later than 11:59 pm, April 20th.
1. Part II must be completed and submitted by not later than 11:59 pm, April 29th. On May 6th you will discuss/present your Final Project with the instructor.

## Guidance

This is a substantial part of the Final Project and your group will likely need to invest 50-70 hours into this part only. I would recommend the following process.
1. This is a data-driven site, so I would recommend beginning by constructing the data access layer: you can use that provided in Lab14 (which I made visible again for your convenience) as your starting point. To begin, create data access objects for Posts, Cities, Countries, Users, and Travel Images. In the architecture you will functionalities such as GetAll() and GetByID() and  additional methods that match the functionality required by the use cases. For instance, the TravelImages data access object, will also need methods such as GetForPost(), GetForUser(), GetForCity, and GetForCountry(). All these other methods are simply wrappers for different SQL statements. Some of these methods can be implemented as you need them.
1. Write testers for each data access object so that you know each works as expected. 
1. Construct your user interface.
1. Customize the bootstrap design.
1. Implement the search results page.
1. Add session abilities for favorites lists.
1. Add mapping functionality.

## Grading
The grade for this assignment will be broken down as follows:
* Usability and visual design	10%
* Program design and documentation	10%
* Features	80%
